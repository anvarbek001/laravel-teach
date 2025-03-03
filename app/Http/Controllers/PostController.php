<?php

namespace App\Http\Controllers;


use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Jobs\TestJob;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $posts = Post::paginate(7);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photo')){
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photo',$name, 'public');
        }


        $request->validate([
            'user' =>auth()->user()->name,
            'title' => 'required|max:255',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'required'
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null,
        ]);



        PostCreated::dispatch($post);

        TestJob::dispatch($post);

        return redirect()->route('posts.index')->with('success' , 'post yaratildi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date, $slug)
    {
         // YYYY-MM-DD formatda sanani tekshiramiz
         $post = Post::whereDate('created_at', $date)
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date,$slug)
    {

        $post = Post::whereDate('created_at', $date)
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date, $slug)
    {
        $post = Post::whereDate('created_at', $date)
                    ->where('slug', $slug)
                    ->firstOrFail();
        Gate::authorize('update-post', $post);

        if($request->hasFile('photo')){
            $url = Storage::url('post-photo/' . $post->photo);

            if(isset($url) && Storage::exists('post-photo/' . $post->photo)){
                Storage::delete($url . $post->photo,);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photo',$name, 'public');
        }

        $request->validate([
            'user' =>auth()->user()->name,
            'title' => 'required|max:255',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048'
        ]);


        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'photo' => $path ?? $post->photo,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', [$date, $slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($date,$slug) {
        $post = Post::whereDate('created_at', $date)
                    ->where('slug', $slug)
                    ->firstOrFail();

        if(isset($post->photo)){
            Storage::delete($post->photo);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
