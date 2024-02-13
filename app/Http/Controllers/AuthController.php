<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function register() {

        
        return view('auth.register');
    }

    public function PostRegister(Request $request) {

        $credential = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::loginUsingId($user->UserID, $request->boolean('remember'));

        return redirect()->route('home')->with('success', 'Вы успешно зарегистрировались');

        
    }


    public function auth() {
        $title = 'Авторизация';
        return view('auth.auth', compact('title'));
    }


    public function PostAuth(Request $request) {

        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($user = User::firstWhere('email', $request['email'])) {
            if (password_verify($request->input('password'), $user->Password)) {
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Вы успешно авторизовались');
            } 
        } 

        return redirect()->route('auth')->with('error', 'Почта или пароль не верны');


    }



    public function logOut(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
