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
    return view('landing.login');
});

Route::get('/register', function () {
    return view('landing.register');
});

Route::get('/forgot-password', function () {
    return view('landing.forgot');
});

Route::get('/reset-password', function () {
    return view('landing.reset-password');
});

Route::get('/home', function () {
    return view('dashboard.home');
});

Route::get('/profile', function () {
    return view('profile.list');
});

Route::get('/feedback', function () {
    return view('feedback.list');
});

Route::get('/book', function () {
    return view('book.list');
});

Route::get('/assess/mental', function () {
    return view('assess.mental');
});

Route::get('/assess/physical', function () {
    return view('assess.physical');
});

Route::get('/assess/emotional', function () {
    return view('assess.emotional');
});

Route::get('/assess/social', function () {
    return view('assess.social');
});

//
Route::get('/evaluate/mental', function () {
    return view('evaluate.mental');
});

Route::get('/evaluate/physical', function () {
    return view('evaluate.physical');
});

Route::get('/evaluate/emotional', function () {
    return view('evaluate.emotional');
});

Route::get('/evaluate/social', function () {
    return view('evaluate.social');
});
