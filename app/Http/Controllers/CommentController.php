<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $comment = Comments::create($request->except(
            '_token',
        ));
        if ($comment) {

            return redirect()->back()->with('success', 'Комментарий создан');
        } 
        return redirect()->back()->withErrors(['Failed' => "Не удалось создать комментарий"]);
    }
}
