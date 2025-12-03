<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;

// ======================
// Guest Routes
// ======================

// Login & Register
Route::get('/login', [AirinsControllerAuth::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');

Route::get('/register', [AirinsControllerAuth::class, 'showRegister'])->name('register');
Route::post('/register', [AirinsControllerAuth::class, 'register'])->name('register.post');

Route::post('/logout', [AirinsControllerAuth::class, 'Logout'])->name('logout');

// Home
Route::get('/home', function () {
    return view('layouts.home');
})->name('home');

// ======================
// Authenticated Routes
// ======================
Route::middleware(['auth'])->group(function () {

    // My Bookings
    Route::get('/mybookings', [BookingController::class, 'index'])->name('mybookings');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');

    // Property Detail
    Route::get('/property/{id}', [PropertyController::class, 'detail'])->name('property.detail');

    // Add Property
    Route::get('/add-property', [PropertyController::class, 'showAdd'])->name('addProperty');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('addProperty.post');

    // My Properties
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('myProperties');

    // Reviews
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.page');
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.submit');
});
