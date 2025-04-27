<?php

// 🌷🌷🌷🌷🌷🌷🌷 ADMIN 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\ObservationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SerologyController;
use App\Http\Controllers\Admin\UserController;

// 🌷🌷🌷🌷🌷🌷🌷 USER 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\User\ArticleController as UserArticleController;

// 🌷🌷🌷🌷🌷🌷🌷 GUEST 🌷🌷🌷🌷🌷🌷🌷


// 🌷🌷🌷🌷🌷🌷🌷 Laravel Things 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// 🌷🌷🌷🌷🌷🌷🌷 Route d'accueil 🌷🌷🌷🌷🌷🌷🌷
Route::get('/', function () {
    return view('welcome');
})->name('home');


// 🌷🌷🌷🌷🌷🌷🌷 Routes d'authentification 🌷🌷🌷🌷🌷🌷🌷
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('client.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', function () {
        return view('client.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});
// 🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷


//🌷🌷🌷🌷🌷🌷 Route de déconnexion 🌷🌷🌷🌷🌷🌷🌷
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
// 🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷


//🌷🌷🌷🌷🌷🌷🌷🌷🌷 Routes des articles (côté utilisateur) 🌷🌷🌷🌷🌷🌷🌷🌷🌷
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [UserArticleController::class, 'index'])->name('index');
    Route::get('/{id}', [UserArticleController::class, 'show'])->name('show');
});
//🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷



//🌷🌷🌷🌷🌷🌷🌷🌷🌷  Routes d'administration  🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Routes pour les utilisateurs
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Routes pour les articles
    Route::resource('articles', ArticleController::class);
    Route::patch('/articles/{id}/archive', [ArticleController::class, 'archive'])->name('articles.archive');
    Route::patch('/articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::post('/upload-trix-attachment', [ArticleController::class, 'uploadTrixAttachment'])->name('articles.upload-trix-attachment');

    // Routes pour les dons
    Route::prefix('donations')->name('donations.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/create', [DonationController::class, 'create'])->name('create');
        Route::post('/', [DonationController::class, 'store'])->name('store');
        Route::get('/{donation}', [DonationController::class, 'show'])->name('show');
        Route::get('/{donation}/edit', [DonationController::class, 'edit'])->name('edit');
        Route::put('/{donation}', [DonationController::class, 'update'])->name('update');
        Route::delete('/{donation}', [DonationController::class, 'destroy'])->name('destroy');
    });

    // Routes pour la sérologie
    Route::put('/serology/{id}', [SerologyController::class, 'update'])->name('serology.update');

    // Routes pour les observations
    Route::post('/observations', [ObservationController::class, 'store'])->name('observations.store');

    // Routes pour les posts et la modération
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'moderationDashboard'])->name('moderation');
        Route::post('/{id}/approve', [PostController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [PostController::class, 'reject'])->name('reject');
        Route::post('/{id}/archive', [PostController::class, 'archive'])->name('archive');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    // Routes pour les commentaires
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
//🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷
