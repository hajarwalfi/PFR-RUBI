<?php

// 🌷🌷🌷🌷🌷🌷🌷 ADMIN 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\ObservationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SerologyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;

// 🌷🌷🌷🌷🌷🌷🌷 USER 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\User\CommentController as UserCommentController;
use App\Http\Controllers\User\DonationController as UserDonationController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;


// 🌷🌷🌷🌷🌷🌷🌷 Laravel Things 🌷🌷🌷🌷🌷🌷🌷
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\EligibilityController;
use Illuminate\Support\Facades\Route;



// 🌷🌷🌷🌷🌷🌷🌷 Route d'accueil 🌷🌷🌷🌷🌷🌷🌷
Route::get('/', [UserArticleController::class, 'home'])->name('home');


// 🌷🌷🌷🌷🌷🌷🌷 Routes d'authentification 🌷🌷🌷🌷🌷🌷🌷
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});
// 🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷


//🌷🌷🌷🌷🌷🌷 Route de déconnexion 🌷🌷🌷🌷🌷🌷🌷
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
// 🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷


//🌷🌷🌷🌷🌷🌷🌷🌷🌷 Routes des articles  🌷🌷🌷🌷🌷🌷🌷🌷🌷
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [UserArticleController::class, 'index'])->name('index');
    Route::get('/articles/all', [App\Http\Controllers\User\ArticleController::class, 'allArticles'])->name('more');
    Route::get('/{id}', [UserArticleController::class, 'show'])->name('show');
});

//Routes de dashboard client
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    //route pour voir les posts
    Route::get('/myPosts', [UserPostController::class, 'myPosts'])->name('myPosts');
    //route pour voir les commentaires
    Route::get('/myComments', [UserCommentController::class, 'myComments'])->name('myComments');
    //route pour voir le profile
    Route::get('/myProfile', [UserCommentController::class, 'myProfile'])->name('myProfile');
    //route pour voir les donations
    Route::get('/myDonations', [UserDonationController::class, 'index'])->name('donations');
    //route pour voir les details de chaque don
    Route::get('/myDonations/{id}', [UserDonationController::class, 'show'])->name('details');
    //route pour voir le profil
    Route::get('/profile', [UserUserController::class, 'show'])->name('profile');
    Route::put('/profile/personal', [UserUserController::class, 'updatePersonalInfo'])->name('profile.update-personal');
    Route::put('/profile/account', [UserUserController::class, 'updateAccountSettings'])->name('profile.update-account');
    Route::put('/profile/password', [UserUserController::class, 'updatePassword'])->name('profile.update-password');
    // route pour voir mes rendez-vous
    Route::get('/appointments', [UserAppointmentController::class, 'index'])->name('appointments');

});

// Routes pour la communauté
Route::prefix('community')->name('user.community.')->middleware(['auth'])->group(function () {
    Route::get('/', [UserPostController::class, 'index'])->name('index');
    Route::get('/create', [UserPostController::class, 'create'])->name('create');
    Route::post('/store', [UserPostController::class, 'store'])->name('store');
    Route::get('/post/{id}', [UserPostController::class, 'show'])->name('show');
    Route::get('/post/{id}/edit', [UserPostController::class, 'edit'])->name('edit');
    Route::put('/post/{id}', [UserPostController::class, 'update'])->name('update');
    Route::delete('/post/{id}', [UserPostController::class, 'destroy'])->name('destroy');
    Route::post('/comments', [UserCommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}/edit', [UserCommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{id}', [UserCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [UserCommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/eligibility', [EligibilityController::class, 'showEligibilityForm'])->name('user.eligibility.form');
    Route::post('/eligibility/check', [EligibilityController::class, 'checkEligibility'])->name('user.eligibility.check');
    Route::get('/appointments/create', [App\Http\Controllers\User\AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [App\Http\Controllers\User\AppointmentController::class, 'store'])->name('appointments.store');
});


































//🌷🌷🌷🌷🌷🌷🌷🌷🌷  Routes d'administration  🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {

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

    // Routes pour les rendez-Vous
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});
//🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷🌷

