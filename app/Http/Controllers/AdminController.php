<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin() {
        $title = 'Админ - BOX PRESS';
        return view('admin.admin', compact('title'));
    }
}
