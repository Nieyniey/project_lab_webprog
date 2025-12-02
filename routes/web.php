<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController; 

<<<<<<< HEAD

// ======================
// Guest Routes
// ======================

Route::get('/login', [AirinsController::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');
Route::post('/logout', [AirinsController::class, 'Logout'])->name('logout');
=======
// Login & Register
Route::get('/login', [AirinsControllerAuth::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');
>>>>>>> cal

Route::get('/register', [AirinsControllerAuth::class, 'showRegister'])->name('register');
Route::post('/register', [AirinsControllerAuth::class, 'register'])->name('register.post');

Route::post('/logout', [AirinsControllerAuth::class, 'Logout'])->name('logout');

// Home
Route::get('/home', function () { 
    return view('layouts.home');
})->name('home');

<<<<<<< HEAD

// ======================
// Authenticated Routes
// ======================
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [AirinsController::class, 'Profile'])->name('profile');

    // Bookings
=======
// Protected Routes (harus login)
Route::middleware('auth')->group(function () {

    // My Bookings
>>>>>>> cal
    Route::get('/mybookings', [BookingController::class, 'index'])->name('mybookings');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');

    // Property Detail
    Route::get('/property/{id}', [PropertyController::class, 'detail'])->name('property.detail');

<<<<<<< HEAD
    // Properties
    Route::get('/add-property', [PropertyController::class, 'showAdd'])->name('addProperty');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('addProperty.post');
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('myProperties');

    // Reviews
=======
    // Review Page 
>>>>>>> cal
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.page');
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.submit');
});
