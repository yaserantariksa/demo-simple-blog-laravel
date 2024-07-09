<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/tags', TagController::class)->only(['index', 'store', 'destroy'])->parameters(['tags' => 'slug']);

    Route::resource('/posts', PostController::class)->parameters(['posts' => 'slug']);
});
