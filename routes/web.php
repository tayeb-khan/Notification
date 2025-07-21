<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
});
