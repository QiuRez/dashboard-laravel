<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
Route::get('/category/{categoryID}', [CategoryController::class, 'category']);

// ГОСТИ (НЕ АВТОРИЗОВАННЫЕ)
Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'PostRegister']);

    Route::get('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::post('/auth', [AuthController::class, 'PostAuth']);
});

// ЗАБАНЕННЫЕ ПОЛЬЗОВАТЕЛИ
Route::group(['middleware' => ['auth', 'banned']], function() {

    Route::get('ad/create-ad', [AdController::class, 'createAdvert'])->name('ad.create');
    Route::post('ad/create-ad', [AdController::class, 'createAdvertPost']);
});

// АДМИНИСТРАТОРЫ
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/ad/rejection/{adId}', [AdminController::class, 'rejection'])->name('admin.rejection');
    Route::get('/admin/ad/approved/{adId}', [AdminController::class, 'approved'])->name('admin.approved');
    Route::get('/admin/user/ban/{userId}', [AdminController::class, 'ban'])->name('user.ban');
    Route::get('/admin/user/unban/{userId}', [AdminController::class, 'unban'])->name('user.unban');
    Route::post('/admin', [AdminController::class, 'newCategory'])->name('admin.newCategory');
    Route::post('/admin', [AdminController::class, 'userEdit'])->name('admin.userEdit');
});

// ВЫХОД
Route::get('/logOut', [AuthController::class, 'logOut'])->name('logOut')->middleware('auth');