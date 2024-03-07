<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request) {
        $comment = Comments::create($request->except(
            '_token',
        ));
        if ($comment) {

            return redirect()->back()->with('success', 'Комментарий создан');
        } 
        return redirect()->back()->withErrors(['Failed' => "Не удалось создать комментарий"]);
    }

    public function delete(Comments $comments) {
        if (Auth::user()->Role == 'Администратор' || Auth::id() == $comments->AuthorUserID) {
            if ($comments) {
                if ($comments->delete()) {
                    return redirect()->back()->with('success', 'Комментарий удален');
                }
                return redirect()->back()->withErrors(['Failed' => "Не удалось удалить комментарий"]);
            } 
        } else {
            return redirect()->back()->withErrors(['Failed' ,'Вы не администратор или комментарий вам не принадлежит']);
        }
    }
}
