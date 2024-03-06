<?php

namespace App\Http\Controllers;

use App\Models\Adverisements;
use App\Models\Category;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(User $user) {
        if ($user) {
            $title = "Пользователь - " . $user->getAttribute('Username');
            
            $ads = Adverisements::with('user')->where([
                ['UserID', $user->getAttribute('UserID')],
                ['Status', 'Одобрено']
            ])->get();

            
            $comments = Comments::with('author')
            ->where('TargetUserId', $user->getAttribute('UserID'))
            ->get();

            $categories = Category::all();

            return view('users.user', compact('title', 'ads', 'comments', 'categories', 'user'));
        }
    }
}
