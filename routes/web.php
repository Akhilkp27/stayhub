<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('index');
})->name('home');

// // Dashboard Route for Jetstream Users
// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Profile Routes (Protected by Jetstream Auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Custom Email Check Route
Route::post('/check-email', [CustomerController::class, 'checkEmail'])->name('check.email');

// Customer Registration Route
Route::post('/registration', [CustomerController::class, 'store'])->name('customer.store');

// Customer Dashboard Route (Protected by Custom 'customer' Guard)
Route::get('/customer-dashboard', [DashboardController::class, 'index']) ->middleware(['auth:customer', 'verified']) ->name('customer.dashboard');
Route::post('customer-login', [CustomAuthController::class, 'login'])->name('customer.login');

// Authentication Routes
Route::get('login', function () {
    return view('auth.login'); // Return the login view
})->name('login');


Route::post('customer-login', [CustomAuthController::class, 'login'])->name('customer.login');

require __DIR__.'/auth.php';
