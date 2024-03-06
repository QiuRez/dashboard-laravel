<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Adverisements;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ВСЕ
Route::get('/', [HomeController::class, 'main'])->name('home');
Route::get('/category/{category}', [CategoryController::class, 'category'])->name('category');
Route::get('/users/{user}', [UserController::class, 'getUser'])->name('users.getUser');

// ГОСТИ (НЕ АВТОРИЗОВАННЫЕ)
Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'PostRegister']);

    Route::get('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::post('/auth', [AuthController::class, 'PostAuth']);
});

// НЕ ЗАБАНЕННЫЕ И АВТОРИЗОРАННЫЕ ПОЛЬЗОВАТЕЛИ
Route::group(['middleware' => ['auth', 'banned']], function() {

    Route::get('ad/create-ad', [AdController::class, 'createAdvert'])->name('ad.create');
    Route::post('ad/create-ad', [AdController::class, 'createAdvertPost']);
    
    Route::resource('comment/create', CommentController::class);
});

// АДМИНИСТРАТОРЫ
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/user/ban/{user}', [AdminController::class, 'ban'])->name('user.ban');
    Route::get('/admin/user/unban/{user}', [AdminController::class, 'unban'])->name('user.unban');
    Route::get('/admin/ad/rejection/{adverisements}', [AdminController::class, 'rejection'])->name('admin.rejection');
    Route::get('/admin/ad/approved/{adverisements}', [AdminController::class, 'approved'])->name('admin.approved');
    Route::post('/admin/category/new', [AdminController::class, 'newCategory'])->name('admin.newCategory');
    Route::post('/admin', [AdminController::class, 'userEdit'])->name('admin.userEdit');
    Route::get('/admin/ad/remove/{adverisements}', [AdController::class, 'removeAd'])->name('ad.removeAd');
    Route::post('/admin/ad/edit', [AdController::class, 'editAd'])->name('ad.editAd');
});

// ВЫХОД
Route::get('/logOut', [AuthController::class, 'logOut'])->name('logOut')->middleware('auth');