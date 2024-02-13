<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category($categoryID) {
        if ($category = Category::firstWhere('CategoryID', $categoryID)) {
            $notFound = false;
            $title = $category->CategoryName;
        } else {
            $notFound = true;
            $title = 'BOX PRESS';
        }

        return view('ad.category', compact('title', 'notFound', 'category', 'categoryID'));
    }
}
