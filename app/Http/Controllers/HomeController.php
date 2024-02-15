<?php

namespace App\Http\Controllers;

use App\Models\Adverisements;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function main()
    {

        $ads = Adverisements::with('user')->Wherehas('user', function (Builder $query) {
            $query->where('Banned', '!=', '1');
        })->with('category')->where('Status', 'Одобрено')->orderBy('Created_at', 'desc')->get();

        $title = 'BOX NEWS';

        return view('home', compact('title', 'ads'));
    }
}
