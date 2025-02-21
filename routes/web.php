<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/announcement/{announcement}', [\App\Http\Controllers\HomeController::class, 'show'])->name('announcements.view');

Route::post('/announcements/{announcement}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('announcements.comments.store');

//Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
//Route::get('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
//Route::post('/category', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
//Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
//Route::get('/category/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
//Route::put('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
//Route::delete('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('/admin/category', \App\Http\Controllers\CategoryController::class);
    Route::resource('/admin/announcements', \App\Http\Controllers\AnnouncementController::class);
});
