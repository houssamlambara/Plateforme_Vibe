<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::get('/user', [ProfileController::class, 'index2'])->name('user');
// Afficher le formulaire de création de post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Enregistrer un post dans la base de données
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Afficher tous les posts
Route::match(['get', 'post'], '/posts', [PostController::class, 'index'])->name('post');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::resource('posts', PostController::class);

require __DIR__ . '/auth.php';
