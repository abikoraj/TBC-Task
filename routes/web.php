<?php

use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('post.list');
});

Route::get('/post/list', [PostController::class, 'list'])->name('post.list');
Route::get('/post/view/{id}', [PostController::class, 'detail'])->name('post.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('post-categories')->name('post-categories.')->group(function () {
        Route::get('/', [PostCategoryController::class, 'index'])->name('index');
        Route::get('/create', [PostCategoryController::class, 'create'])->name('create');
        Route::post('/', [PostCategoryController::class, 'store'])->name('store');
        Route::get('/{postCategory}/edit', [PostCategoryController::class, 'edit'])->name('edit');
        Route::patch('update/{postCategory}', [PostCategoryController::class, 'update'])->name('update');
        Route::get('delete/{postCategory}', [PostCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
