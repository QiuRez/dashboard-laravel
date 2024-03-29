<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->Role == 'Администратор') {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
