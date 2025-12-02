<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AirinsControllerAuth::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');

Route::get('/register', [AirinsControllerAuth::class, 'showRegister'])->name('register');
Route::post('/register', [AirinsControllerAuth::class, 'register'])->name('register.post');

Route::post('/logout', [AirinsControllerAuth::class, 'Logout'])->name('logout');

Route::get('/home', function () { return view('layouts.home');})->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/mybookings', [BookingController::class, 'index'])
        ->name('mybookings');

    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])
        ->name('cancel.booking');

    Route::get('/property/{id}', [PropertyController::class, 'detail'])
        ->name('property.detail');
});

Route::get('/review/{id}', [ReviewController::class, 'show'])
     ->name('review.page')
     ->middleware('auth');


