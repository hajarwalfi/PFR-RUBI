<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/posts', function () {
    return view('Admin.Posts.index');
});
Route::resource('articles', ArticleController::class);

Route::post('/admin/upload-trix-attachment', [ArticleController::class, 'uploadTrixAttachment'])->name('upload.trix-attachment');

Route::put('/serology/{id}', [App\Http\Controllers\SerologyController::class, 'update'])->name('Serology.update');

Route::post('/observations', [App\Http\Controllers\ObservationController::class, 'store'])->name('Observations.store');
    Route::get('/users', [UserController::class, 'index'])->name('Users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('Users.create');
    Route::post('/users', [UserController::class, 'store'])->name('Users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('Users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('Users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('Users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('Users.destroy');


Route::get('Donations/create', [DonationController::class, 'create'])->name('Donations.create');
Route::post('Donations', [DonationController::class, 'store'])->name('Donations.store');
Route::get('Donations/{donation}', [DonationController::class, 'show'])->name('Donations.show');
Route::get('Donations/{donation}/edit', [DonationController::class, 'edit'])->name('Donations.edit');
Route::put('Donations/{donation}', [DonationController::class, 'update'])->name('Donations.update');
Route::get('/donations/{id}/edit', [App\Http\Controllers\DonationController::class, 'edit'])->name('Donations.edit');
Route::put('/donations/{id}', [App\Http\Controllers\DonationController::class, 'update'])->name('Donations.update');

Route::patch('/articles/{id}/archive', [ArticleController::class, 'archive'])->name('articles.archive');
Route::patch('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');





    Route::get('/posts', [App\Http\Controllers\PostController::class, 'moderationDashboard'])
        ->name('moderation');

    // Post actions
    Route::post('/posts/{id}/approve', [App\Http\Controllers\PostController::class, 'approve'])
        ->name('posts.approve');
    Route::post('/posts/{id}/reject', [App\Http\Controllers\PostController::class, 'reject'])
        ->name('posts.reject');
    Route::post('/posts/{id}/archive', [App\Http\Controllers\PostController::class, 'archive'])
        ->name('posts.archive');
Route::delete('/posts/{id}', [App\Http\Controllers\PostController::class, 'destroy'])
    ->name('posts.destroy');
Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])
    ->name('comments.destroy');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/welcome', function () {
    return view('Client.welcome');
});
Route::get('/login', function () {
    return view('Client.login');
});
