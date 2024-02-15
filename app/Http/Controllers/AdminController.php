<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adverisements;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function admin() {
        $ads = Adverisements::Wherehas('user', function(Builder $query) {
                $query->where('Banned', '!=', '1');
        })->with('category')->where('Status', 'На рассмотрении')->get();

        $users = User::all();

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
}
