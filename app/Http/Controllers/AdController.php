<?php

namespace App\Http\Controllers;

use App\Models\Adverisements;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function createAdvert()
    {

        $categories = Category::all();

        $title = "Создать объявление";

        return view('ad.create', compact('title', 'categories'));
    }

    public function createAdvertPost(Request $request)
    {

        $messages = [
            'title.required' => "Поле заголовка пустое",
            'title.min' => "Для заголовка требуется минимум 2 символа",
            'title.max' => "Для заголовка требуется максимум 40 символов",
            'description.required' => 'Поле текста пустое',
            'description.min' => "Для текста требуется минимум 5 символа",
            'description.max' => "Для текста требуется максимум 255 символов",
            'category.required' => 'Выберите категорию'
        ];

        $request->validate([
            'title' => 'required|min:2|max:40',
            'description' => 'required|min:5|max:255',
            'image' => 'mimes:jpg,png,jpeg|max:2048|dimensions:min_width=40,min_height=40,max_width=2000,max_height=2000',
            'category' => 'required'
        ], $messages);

        if ($file = $request->file('image')) {
            $fileName = time() . random_int(0, 255) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/ad'), $fileName);

        } else $fileName = false;

        $path = $fileName ? 'images/ad/' . $fileName : '';

        Adverisements::create([
            'UserID' => Auth::user()->UserID,
            'CategoryID' => $request->input('category'),
            'Title' => $request->input('title'),
            'Description' => $request->input('description'),
            'AdPhoto' => $path,
            'Status' => 'На рассмотрении'
        ]);

        return redirect()->route('home');
    }

    public function removeAd($adId) {
        $ad = Adverisements::find($adId);
        $ad->delete();
        return redirect()->back()->with('success', 'Объявление удалено');
    }
}
