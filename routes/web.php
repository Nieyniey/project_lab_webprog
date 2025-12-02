<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;


// ======================
// Guest Routes
// ======================

Route::get('/login', [AirinsController::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsController::class, 'Login'])->name('login.post');
Route::post('/logout', [AirinsController::class, 'Logout'])->name('logout');

Route::get('/register', [AirinsController::class, 'Register'])->name('register');

Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/search', [PropertyController::class, 'search'])->name('search');

Route::get('/property/{id}', [PropertyController::class, 'detail'])->name('property.detail');
Route::post('/property/{id}/book', [BookingController::class, 'book'])->name('bookProperty');


// ======================
// Authenticated Routes
// ======================
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [AirinsController::class, 'Profile'])->name('profile');

    // Bookings
    Route::get('/mybookings', [BookingController::class, 'index'])->name('mybookings');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorite/{id}/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

    // Properties
    Route::get('/add-property', [PropertyController::class, 'showAdd'])->name('addProperty');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('addProperty.post');
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('myProperties');

    // Reviews
    Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review.page');
    Route::post('/review/{id}', [ReviewController::class, 'store'])->name('review.submit');
});
