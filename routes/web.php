<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController; 
use App\Http\Controllers\ProfileController;

// Login & Register
Route::get('/login', [AirinsControllerAuth::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsControllerAuth::class, 'Login'])->name('login.post');

Route::get('/register', [AirinsControllerAuth::class, 'showRegister'])->name('register');
Route::post('/register', [AirinsControllerAuth::class, 'register'])->name('register.post');

Route::post('/logout', [AirinsControllerAuth::class, 'Logout'])->name('logout');

// Home and Search Page
Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/search', [PropertyController::class, 'search'])->name('search');
Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.detail');

// Admin and Members Only
Route::middleware('auth')->group(function () {
    // Property Detail Booking
    Route::post('/property/{id}/book', [BookingController::class, 'book'])->name('property.book');

    // My Properties
    Route::get('/myproperties', [PropertyController::class, 'myProperties'])->name('myProperties');

    // Add Property
    Route::get('/addproperty', [PropertyController::class, 'showAdd'])->name('property.add');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');

    // Edit Properties
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');

    // My Bookings
    Route::get('/mybookings', [BookingController::class, 'index'])->name('mybookings');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');

    // Review Page 
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.page');
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.submit');    
});

// // user profile
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });

// Members Only (kalau testing, ini di comment aja)
// Route::middleware(['auth', 'member'])->group(function () {
//     // Favorite Page
//     Route::get('/favorites', [PropertyController::class, 'favorites'])->name('favorites');
// });

// user profile (only member can access)
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

