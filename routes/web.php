<?php

use Illuminate\Support\Facades\Route;

// User Authentication Routes
Auth::routes();

// Home Route
Route::redirect('/', '/posts');


// Admin Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');


// Admin Protected Routes
Route::middleware('admin')->prefix('admin')->group(function () {

    // User Management Routes
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

// User Protected Routes
Route::middleware(['auth'])->group(function () {
    // Post Routes
    Route::resource('posts', App\Http\Controllers\PostController::class);

    // Comment Routes
    Route::prefix('posts/{post}')->group(function () {
        Route::resource('comments', App\Http\Controllers\CommentController::class)->names([
            'index' => 'posts.comments.index',
            'create' => 'posts.comments.create',
            'store' => 'posts.comments.store',
            'edit' => 'posts.comments.edit',
            'update' => 'posts.comments.update',
            'destroy' => 'posts.comments.destroy',
        ])->parameters(['comments' => 'comment']);
    });
});
