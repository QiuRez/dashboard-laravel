<?php

namespace App\Http\Controllers;

use App\Models\Adverisements;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(Category $category) {
        if ($category) {
            
            $ads = Adverisements::Wherehas('user', function(Builder $query) {
                $query->where('Banned', '!=', '1');
            })->where([['CategoryID', $category->CategoryID], ['Status', 'Одобрено']])->get();
            
            $categories = Category::all();
            $categoryID = $category->CategoryID;

            $notFound = false;
            $title = $category->CategoryName;
        } else {
            $ads = False;
            $notFound = true;
            $title = 'BOX PRESS';
        }

        return view('ad.category', compact('title', 'notFound', 'category', 'categoryID', 'ads', 'categories'));
    }
}
