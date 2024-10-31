<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', function () {
    $user = User::where('name', '=', 'Rubben')->first();
    return view('profile', compact('user'));
})->name('profile');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
