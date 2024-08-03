<?php

use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

Route::get('post-categories', [DataController::class, 'postCategories']);

Route::get('/post/list', [PostController::class, 'list'])->name('post.list');
Route::get('/post/view/{id}', [PostController::class, 'detail'])->name('post.view');

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout']);

    Route::prefix('post-categories')->group(function () {
        Route::get('/index', [PostCategoryController::class, 'index']);
        Route::post('/store', [PostCategoryController::class, 'store']);
        Route::post('update/{id}', [PostCategoryController::class, 'update']);
        Route::delete('delete/{id}', [PostCategoryController::class, 'destroy']);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/index', [PostController::class, 'index']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('show/{id}', [PostController::class, 'show']);
        Route::post('update/{id}', [PostController::class, 'update']);
        Route::delete('delete/{id}', [PostController::class, 'destroy']);
    });
});
