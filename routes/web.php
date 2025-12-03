<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;
<<<<<<< HEAD
use App\Http\Controllers\ReviewController;

// ======================
// Guest Routes
// ======================
=======
use App\Http\Controllers\ReviewController; 
>>>>>>> d3464bd92d6bb2612bbbba52ee953777727c5319

// Login & Register
Route::get('/login', [AirinsControllerAuth::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');

Route::get('/register', [AirinsControllerAuth::class, 'showRegister'])->name('register');
Route::post('/register', [AirinsControllerAuth::class, 'register'])->name('register.post');

Route::post('/logout', [AirinsControllerAuth::class, 'Logout'])->name('logout');

<<<<<<< HEAD
// Home
Route::get('/home', function () {
    return view('layouts.home');
})->name('home');

// ======================
// Authenticated Routes
// ======================
Route::middleware(['auth'])->group(function () {
=======
// Home and Search Page
Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/search', [PropertyController::class, 'search'])->name('search');
Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.detail');

// Protected Routes (harus login)
Route::middleware('auth')->group(function () {
    // Property Detail Book
    Route::post('/property/{id}/book', [BookingController::class, 'book'])->name('property.book');
>>>>>>> d3464bd92d6bb2612bbbba52ee953777727c5319

    // My Bookings
    Route::get('/mybookings', [BookingController::class, 'index'])->name('mybookings');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');

<<<<<<< HEAD
    // Property Detail
    Route::get('/property/{id}', [PropertyController::class, 'detail'])->name('property.detail');

    // Add Property
    Route::get('/add-property', [PropertyController::class, 'showAdd'])->name('addProperty');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('addProperty.post');

    // My Properties
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('myProperties');

    // Reviews
=======
    // Review Page 
>>>>>>> d3464bd92d6bb2612bbbba52ee953777727c5319
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.page');
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.submit');
});
