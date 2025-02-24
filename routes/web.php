<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::get('/user', [ProfileController::class, 'index2'])->name('user');
// Afficher le formulaire de création de post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Afficher tous les posts
Route::match(['get', 'post'], '/posts', [PostController::class, 'index'])->name('post');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts', PostController::class);

require __DIR__ . '/auth.php';
