<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('posts');
        }
    }

    public function register_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->roles()->attach(3);

        auth()->login($user);

        return redirect('posts')->with('success', "Account successfully registered.");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('posts.index');
    }

    public function seller(){
        return view('auth.seller');
    }

    public function seller_store(Request $request){
        $validated=$request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->roles()->attach(4);
        auth()->login($user);

        return redirect()->route('posts.index');
    }
}
