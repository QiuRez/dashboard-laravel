<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function register() {
        $title = 'Регистрация';
        
        return view('auth.register', compact('title'));
    }

    public function PostRegister(Request $request) {

        $messages = [
            'username' => ['unique' => 'Имя пользователя уже занято'],
            'email' => ['unique' => 'Такая почта уже зарегистрирована', 'email' => 'Недопустимый формат почты'],
            'password' => ['required' => 'Заполните поле пароля'],
        ];

            // 'dimensions' => 'Изображение имеет недопустимые размеры.',
            // 'mimes' => 'Изображение имеет недопустимое расширение. Допустимые: jpg,png,jpeg,gif',
        $credential = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'image' => 'mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=40,min_height=40,max_width=2000,max_height=2000',
        ], $messages);

        if ($file = $request->file('image')) {
            $fileName = time() . random_int(0,255) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/users'), $fileName);
            $path = 'images/users/'. $fileName;
        } else {
            $path = 'images/users/default.png';
        }

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'UserPhoto' => $path
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
