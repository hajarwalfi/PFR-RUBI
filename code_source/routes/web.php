<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\SerologyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
    });

    // Donor Routes
    Route::middleware('role:donor')->prefix('donor')->name('donor.')->group(function () {
        Route::get('/dashboard', function () {
            return view('donor.dashboard');
        })->name('dashboard');
    });
});

Route::middleware(['auth', 'check.access:admin,admin'])->prefix('admin')->name('admin.')->group(function () {

    // Posts management
    Route::get('/posts', function () {
        return view('Admin.Posts.index');
    })->name('posts.index');

    Route::get('/posts/moderation', [PostController::class, 'moderationDashboard'])
        ->name('posts.moderation');

    // Post actions
    Route::post('/posts/{id}/approve', [PostController::class, 'approve'])
        ->name('posts.approve');
    Route::post('/posts/{id}/reject', [PostController::class, 'reject'])
        ->name('posts.reject');
    Route::post('/posts/{id}/archive', [PostController::class, 'archive'])
        ->name('posts.archive');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])
        ->name('posts.destroy');

    // Comments management
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    // Articles management
    Route::resource('articles', ArticleController::class);
    Route::patch('/articles/{id}/archive', [ArticleController::class, 'archive'])->name('articles.archive');
    Route::patch('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::post('/upload-trix-attachment', [ArticleController::class, 'uploadTrixAttachment'])->name('upload.trix-attachment');

    // Users management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Donations management
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
    Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');

    // Medical data management
    Route::put('/serology/{id}', [SerologyController::class, 'update'])->name('serology.update');
    Route::post('/observations', [ObservationController::class, 'store'])->name('observations.store');
});

Route::get('/welcome', function () {
    return view('Client.welcome');
});

Route::get('/login', function () {
    return view('Client.login');
})->name('Client.login');
