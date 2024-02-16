<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adverisements;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\Response;

class AdminController extends Controller
{
    public function admin() {
        $ads = Adverisements::Wherehas('user', function(Builder $query) {
                $query->where('Banned', '!=', '1');
        })->with('category')->where('Status', 'На рассмотрении')->orderBy('Created_at')->get();

        $users = User::orderBy('Role')->orderBy('Username')->get();

        $title = 'Админ - BOX PRESS';
        return view('admin.admin', compact('title', 'ads', 'users'));
    }

    public function rejection($adId) {
        $ad = Adverisements::find($adId);
        $ad->Status = 'Отклонено';
        $ad->save();
        return redirect()->route('admin');
    }

    public function approved($adId) {
        $ad = Adverisements::find($adId);
        $ad->Status = 'Одобрено';
        $ad->save();
        return redirect()->route('admin');
    }

    public function ban($userId) {
        $user = User::find($userId);
        $user->Banned = 1;
        $user->save();
        return redirect()->route('admin');
    }
    public function unban($userId) {
        $user = User::find($userId);
        $user->Banned = 0;
        $user->save();
        return redirect()->route('admin');
    }
    
    public function newCategory(Request $request) {
        $validate = $request->validate([
            'newCategory' => 'required|min:2|max:40|string|unique:categories,CategoryName',
        ]);

        Category::create([
            'CategoryName' => $request->input('newCategory'),
        ]);

        return redirect()->route('admin');
    }

    public function userEdit(Request $request) {

        $validate = $request->validate([
            'username' => 'min:2|string',
            'email' => 'email|string',
            'userId'=> 'required'
        ]);

        $user = User::find($request->input('userId'));
        $errors = [];
        $success = [];

        if ($user->Username != $request->input('username')) {
            if (!User::firstWhere('Username', $request->input('username'))) {
                $user->Username = $request->input('username');
                array_push($success, ['user' => 'Имя пользователя обновлено']);
            } else {
                array_push($errors, ['user' => 'Имя пользователя уже используется']);
            }
        }
        if ($user->Email != $request->input('email')) {
            if (!User::firstWhere('Email', $request->input('email'))) {
                $user->Email = $request->input('email');
                array_push($success, ['email' => 'Почта пользователя обновлена']);
            } else {
                array_push($errors, ['email' => 'Почта уже используется']);
            }
        }
        $user->save();


        return redirect()->back()->withErrors($errors)->with('success', $success);
    }

}
