<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TEEEST

// Route::get('/test', function (Request $request) {

//     return [
//         "name" => $request->input('name', 'Houssam'),
//     ];
// });

// Route::get('/test/{slug}-{id}', function (string $slug, string $id) {

//     return [
//         "slug"=>$slug,
//         "id"=>$id
//     ];
// });

require __DIR__ . '/auth.php';
