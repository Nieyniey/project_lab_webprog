<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsControllerAuth;
use App\Http\Controllers\AirinsController;
use App\Http\Controllers\PropertyController;

// Guest
Route::get('/login', [AirinsController::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsController::class, 'Login'])->name('login.post');
Route::post('/logout', [AirinsController::class, 'Logout'])->name('logout');
Route::get('/register', [AirinsController::class, 'Register'])->name('register');

Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/search', [PropertyController::class, 'search'])->name('search');

Route::get('/property/{id}', [PropertyController::class, 'detail'])->name('propertyDetail');
Route::post('/property/{id}/book', [BookingController::class, 'book'])->name('bookProperty');

// Member and Admin
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [AirinsController::class, 'Profile'])->name('profile');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorite/{id}/toggle', [FavoriteController::class, 'toggle'])
        ->name('favorite.toggle');

    Route::get('/add-property', [PropertyController::class, 'showAdd'])->name('addProperty');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('addProperty.post');

    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('myProperties');
});