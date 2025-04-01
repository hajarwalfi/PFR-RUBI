<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('Admin.Users.users');
});
Route::get('/userDetails', function () {
    return view('Admin.Users.userDetails');
});
Route::get('/donationDetails', function () {
    return view('Admin.Users.DonationDetails');
});
Route::get('/modifyDonation', function () {
    return view('Admin.Users.ModifyDonationDetails');
});
Route::get('/addDonation', function () {
    return view('Admin.Users.AddDonation');
});
Route::get('/modifyUser', function () {
    return view('Admin.Users.ModifyUserInformation');
});
