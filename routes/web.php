<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () { return view('welcome'); })->name('home')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'checkRole:admin,moderator'])->group(function () {
    Route::get('/', function () { return view('admin.index'); })->name('home');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/posts', \App\Http\Controllers\Admin\PostController::class);
});

Route::get('/login', [\App\Http\Controllers\UserController::class, 'loginForm'])->name('login.create');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login');

Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout')->middleware('auth');


