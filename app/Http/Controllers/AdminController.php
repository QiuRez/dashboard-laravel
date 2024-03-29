<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use Illuminate\Http\Request;
use App\Models\Adverisements;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;

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

    public function rejection(Adverisements $adverisements) {
        $adverisements->with('user');
        $adverisements->Status = 'Отклонено';
        $adverisements->save();

        adminLog('Отклонил объявление', $adverisements->user->UserID, $adverisements->AdID);
        return redirect()->route('admin');
    }

    public function approved(Adverisements $adverisements) {
        $adverisements->with('user');
        $adverisements->Status = 'Одобрено';
        $adverisements->save();
        adminLog('Принял объявление', $adverisements->user->UserID, $adverisements->AdID);
        return redirect()->route('admin');
    }

    public function ban(User $user) {
        $user->Banned = 1;
        $user->save();

        adminLog('Забанил пользователя', $user->UserID);
        return redirect()->route('admin');
    }
    public function unban(User $user) {
        $user->Banned = 0;
        $user->save();

        adminLog('Разбанил пользователя', $user->UserID);
        return redirect()->route('admin');
    }
    
    public function newCategory(Request $request) {
        $request->validate([
            'newCategory' => 'required|min:2|max:40|string|unique:categories,CategoryName',
        ]);

        Category::create([
            'CategoryName' => $request->input('newCategory'),
        ]);

        adminLog('Добавил категорию "' . $request->input('newCategory') . '"');

        return redirect()->back()->with('success', 'Категория создана');
    }

    public function userEdit(Request $request) {

        $request->validate([
            'username' => 'min:2|string',
            'email' => 'email|string',
            'userId'=> 'required'
        ]);

        $user = User::find($request->input('userId'));
        $errors = [];
        $success = [];

        if ($user->Username != $request->input('username')) {
            if (!User::firstWhere('Username', $request->input('username'))) {
                $success['user'] = "Имя пользователя '{$user->Username}' изменено на '{$request->input('username')}'";
                $user->Username = $request->input('username');
            } else {
                array_push($errors, ['user' => 'Имя пользователя уже используется']);
            }
        }
        if ($user->Email != $request->input('email')) {
            if (!User::firstWhere('Email', $request->input('email'))) {
                $success['email'] = "Почта пользователя '{$user->Email}' обновлена на '{$request->input('email')}'";
                $user->Email = $request->input('email');
            } else {
                array_push($errors, ['email' => 'Почта уже используется']);
            }
        }
        $user->save();

        $result = implode('. ', $success);

        adminLog($result, $user->UserID);

        return redirect()->back()->withErrors($errors)->with('success', $success);
    }

}