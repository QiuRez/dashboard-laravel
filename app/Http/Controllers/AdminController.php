<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adverisements;
use App\Models\User;

class AdminController extends Controller
{
    public function admin() {
        $ads = Adverisements::has('user')->where('Status', 'На рассмотрении')->get();
        $user = Adverisements::with('user')->get();
        $title = 'Админ - BOX PRESS';
        return view('admin.admin', compact('title', 'ads', 'user'));
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
}
