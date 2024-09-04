<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\StaffController;
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
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });





// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('common.login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Customer Routes
Route::middleware(['auth:customer'])->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::post('/check-email', [CustomerController::class, 'checkEmail'])->name('check.email');
    Route::post('/registration', [CustomerController::class, 'store'])->name('store');
    
});

// Staff Routes
Route::middleware(['auth:staff'])->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
    Route::get('/profile', [StaffController::class, 'profile'])->name('profile');
    
});

// Admin Routes
Route::middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    
});

require __DIR__.'/auth.php';
