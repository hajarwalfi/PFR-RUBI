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





    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.myPosts');
    Route::delete('/media/{id}', [PostController::class, 'removeMedia'])->name('media.destroy');

    Route::get('/posts/pending', [PostController::class, 'pendingPosts'])->name('posts.pending');
    Route::get('/posts/approved', [PostController::class, 'approvedPosts'])->name('posts.approved');
    Route::get('/posts/rejected', [PostController::class, 'rejectedPosts'])->name('posts.rejected');
    Route::get('/posts/archived', [PostController::class, 'archivedPosts'])->name('posts.archived');
    Route::get('/posts/{id}', [PostController::class, 'adminShow'])->name('posts.adminShow');
    Route::post('/posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');
    Route::post('/posts/{id}/archive', [PostController::class, 'archive'])->name('posts.archive');

    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

