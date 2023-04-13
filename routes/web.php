<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhysicalHealthController;
use App\Http\Controllers\PhysicalHealthEvaluationController;
use App\Http\Controllers\UserController;
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
    // Route::controller(LogoutController::class)->group(function () {
    //     Route::post('/away', 'logout')->name('away');
    // });

    Route::controller(UserController::class)->group(function () {
        Route::patch('/update', 'updateBio')->name('update');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });

    // Route::get('/bio', function () {
    //     return view('landing.bio');
    // });

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

    Route::controller(PhysicalHealthController::class)->group(function () {
        Route::get('/assess/physical', 'assessment');
        Route::get('/questions/physical', 'index');
        Route::post('save', 'store')->name('physical.save');
        Route::patch('physical/{physicalHealth}', 'update')->name('physical/{physicalHealth}');
        Route::post('delete/{physicalHealth}', 'destroy')->name('delete/{physicalHealth}');
    });

    Route::controller(PhysicalHealthEvaluationController::class)->group(function () {
        Route::post('answer', 'store')->name('physical.answer');
    });
});

Route::fallback(function () {
    return view('404.404');
});
