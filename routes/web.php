<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmotionalHealthController;
use App\Http\Controllers\EmotionalHealthEvaluationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MentalHealthController;
use App\Http\Controllers\MentalHealthEvaluationController;
use App\Http\Controllers\PhysicalHealthController;
use App\Http\Controllers\PhysicalHealthEvaluationController;
use App\Http\Controllers\SocialWellbeingController;
use App\Http\Controllers\SocialWellbeingEvaluationController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
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

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::patch('/update', 'updateBio')->name('update');
        Route::patch('/profile/update', 'updateProfile')->name('profile.update');
        Route::get('/profile', 'index');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/feed', 'feed')->name('feed');
    });

    Route::controller(FeedbackController::class)->group(function () {
        Route::get('/say', 'index');
        Route::post('/feedback/store', 'store')->name('feedback.store');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::get('/book', 'index')->name('book');
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
        Route::get('physical/score', 'evaluate');
        Route::get('/evaluate/physical', 'index');
    });

    Route::controller(SocialWellbeingController::class)->group(function () {
        Route::get('/assess/social', 'assessment');
        Route::get('/questions/social', 'index');
        Route::post('social/save', 'store')->name('social.save');
        Route::patch('social/{socialWellbeing}', 'update')->name('social/{socialWellbeing}');
        Route::post('social/delete/{socialWellbeing}', 'destroy')->name('social/delete/{socialWellbeing}');
    });

    Route::controller(SocialWellbeingEvaluationController::class)->group(function () {
        Route::post('social/answer', 'store')->name('social.answer');
        Route::get('social/score', 'evaluate');
        Route::get('/evaluate/social', 'index');
    });

    Route::controller(EmotionalHealthController::class)->group(function () {
        Route::get('/assess/emotional', 'assessment');
        Route::get('/questions/emotional', 'index');
        Route::post('emotional/save', 'store')->name('emotional.save');
        Route::patch('emotional/{emotionalHealth}', 'update')->name('emotional/{emotionalHealth}');
        Route::post('emotional/delete/{emotionalHealth}', 'destroy')->name('emotional/delete/{emotionalHealth}');
    });

    Route::controller(EmotionalHealthEvaluationController::class)->group(function () {
        Route::post('emotional/answer', 'store')->name('emotional.answer');
        Route::get('emotional/score', 'evaluate');
        Route::get('/evaluate/emotional', 'index');
    });

    Route::controller(MentalHealthController::class)->group(function () {
        Route::get('/assess/mental', 'assessment');
        Route::get('/questions/mental', 'index');
        Route::post('mental/save', 'store')->name('mental.save');
        Route::patch('mental/{mentalHealth}', 'update')->name('mental/{mentalHealth}');
        Route::post('mental/delete/{mentalHealth}', 'destroy')->name('mental/delete/{mentalHealth}');
    });

    Route::controller(MentalHealthEvaluationController::class)->group(function () {
        Route::post('mental/answer', 'store')->name('mental.answer');
        Route::get('mental/score', 'evaluate');
        Route::get('/evaluate/mental', 'index');
    });
});

Route::fallback(function () {
    return view('404.404');
});
