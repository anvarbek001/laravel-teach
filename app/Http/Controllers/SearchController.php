<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->q;
            $posts = Post::where('title', 'LIKE', "%{$q}%")
                ->orWhere('short_content', 'LIKE', "%{$q}%")
                ->orWhereHas('user', function ($query) use ($q) {
                    $query->where('name', 'LIKE', "%{$q}%"); // Foydalanuvchi nomi bo‘yicha qidirish
                })
                ->orWhere('created_at', 'LIKE', "%{$q}%") // Sana bo‘yicha qidirish
                ->get();

            return response()->json($posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'user_name' => $post->user->name ?? 'Unknown',
                    'title' => $post->title,
                    'short_content' => $post->short_content,
                    'image_url' => asset('storage/' . $post->photo),
                    'created_at' => $post->created_at->format('Y-m-d H:i'),
                    'slug' => $post->slug
                ];
            }));
        } else {
            return response()->json([]);
        }
    }
}
