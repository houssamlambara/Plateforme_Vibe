<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les likes
    Route::post('/posts/{id}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');

    // Routes pour les commentaires
    Route::get('/comments/{id}/edit', [PostController::class, 'editComment'])->name('comments.edit');
    Route::put('/comments/{id}', [PostController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{id}', [PostController::class, 'deleteComment'])->name('comments.delete');
});

// Routes pour les amis
Route::prefix('friends')->middleware('auth')->group(function () {
    // Envoi de demande d'ami
    Route::post('friend-request/{friendId}', [FriendController::class, 'sendRequest'])->name('friends.sendRequest');

    // Accepter ou refuser une demande d'ami
    Route::post('friend-request/respond/{friendId}/{action}', [FriendController::class, 'respondToRequest'])->name('friends.respond');

    // Afficher la liste des amis
    Route::get('/', [FriendController::class, 'showFriends'])->name('friends.index');
});

// Dashboard et autres routes
Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::get('/user', [ProfileController::class, 'index2'])->name('user');

// Routes pour les posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post', [PostController::class, 'store'])->name('post');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts', PostController::class);

// Routes pour les commentaires sur les posts
Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');

require __DIR__ . '/auth.php';
