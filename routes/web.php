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

// // Routes pour les amis
Route::middleware(['auth'])->group(function () {
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends/send/{user}', [FriendController::class, 'sendRequest'])->name('friends.sendRequest');
    Route::post('/friends/accept/{request}', [FriendController::class, 'acceptRequest'])->name('friends.acceptRequest');
    Route::post('/friends/decline/{request}', [FriendController::class, 'declineRequest'])->name('friends.declineRequest');
    Route::post('/friends/clear-sent-requests', [FriendController::class, 'clearSentRequests'])->name('friends.clearSentRequests');
    Route::post('/friends/cancel-sent-requests', [FriendController::class, 'cancelSentRequests'])->name('friends.cancelSentRequests');
});

// Dashboard et autres routes
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

// Routes pour les commentaires sur les posts
Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');

require __DIR__ . '/auth.php';
