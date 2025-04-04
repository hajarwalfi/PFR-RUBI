<?php

use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
//Route::get('/', function () {
//    return view('Admin.Users.users');
//});
//Route::get('/userDetails', function () {
//    return view('Admin.Users.userDetails');
//});
//Route::get('/donationDetails', function () {
//    return view('Admin.Users.DonationDetails');
//});
//Route::get('/modifyDonation', function () {
//    return view('Admin.Users.ModifyDonationDetails');
//});
//Route::get('/addDonation', function () {
//    return view('Admin.Users.AddDonation');
//});
Route::get('/posts', function () {
   return view('Admin.Posts.index');
});
Route::resource('articles', App\Http\Controllers\ArticleController::class);



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
