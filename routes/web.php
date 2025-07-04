<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // Add this line
use Illuminate\Support\Facades\Route;

// Add these use statements for your resource controllers (if not already there)
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleController;

Route::get('/', function () {
    return view('welcome');
});

// OLD:
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// NEW: Updated to use the DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Your existing resource routes
    Route::resource('payment_methods', PaymentMethodController::class);
    Route::resource('payment_types', PaymentTypeController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('rentals', RentalController::class);
    Route::resource('user_types', UserTypeController::class);
    Route::resource('users', UserController::class);
    Route::resource('vehicle_types', VehicleTypeController::class);
    Route::resource('vehicles', VehicleController::class);
});

require __DIR__.'/auth.php';