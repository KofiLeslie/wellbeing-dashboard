<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth/login');
});


// Route::controller(LogoutController::class)->group(function () {
//     Route::post('/away', 'logout')->name('away');
// });
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::controller(LogoutController::class)->group(function () {
        Route::post('/away', 'logout')->name('away');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
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
});
