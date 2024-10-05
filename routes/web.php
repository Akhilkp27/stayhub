<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\StaffManagementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    //staff-management
    Route::prefix('staff-management')->group(function () {
        Route::get('/staff-list', [StaffManagementController::class, 'viewStaffList'])->name('view-staff-list');
        Route::post('/add-new-staff', [StaffManagementController::class, 'addNewStaff'])->name('add-new-staff');
        Route::get('/edit-staff-modal', [StaffManagementController::class, 'getStaffDataForEdit'])->name('get-staff-data-for-edit');
        Route::put('/update-staff', [StaffManagementController::class, 'updateStaffData'])->name('update-staff');
        Route::get('/role-list', [StaffManagementController::class, 'viewRoleList'])->name('view-role-list');
        Route::get('/activity-log', [StaffManagementController::class, 'viewActivityLog'])->name('view-activity-log');
    });

    //room-management
    Route::prefix('room-management')->group(function () {
        //room type
        Route::get('/add-room-type', [RoomController::class, 'viewAddRoomType'])->name('add-room-type');
        Route::post('/store-room-type',[RoomController::class, 'storeRoomType'])->name('store-room-type');
        Route::post('/update-room-type', [RoomController::class, 'updateRoomType'])->name('update-room-type');
        Route::delete('/delete-room-type/{id}', [RoomController::class, 'deleteRoomType'])->name('delete-room-type');

        // common routes
        Route::get('/check-if-exists', [RoomController::class, 'checkIfExists'])->name('check-if-exists');
        Route::get('/get-data-for-edit', [RoomController::class, 'getDataForEdit'])->name('get-data-for-edit');
        Route::get('/get-table-data', [RoomController::class, 'getTableData'])->name('get-table-data');

        //room-amenities
        Route::get('/room-amenities', [RoomController::class, 'viewRoomAmenities'])->name('view-room-amenities');
        Route::post('/store-amenity', [RoomController::class, 'storeAmenity'])->name('store-amenity');
        Route::post('/update-amenity', [RoomController::class, 'updateAmenity'])->name('update-amenity');

        //room-status
        Route::get('/room-status',[RoomController::class,'viewAddRoomStatus'])->name('add-room-status');
        Route::post('/store-room-status', [RoomController::class, 'storeRoomStatus'])->name('store-room-status');
    });
    
});

Route::middleware('auth:staff')->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
});

Route::middleware('auth:customer')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
});

Route::post('/check-email', [CustomerController::class, 'checkEmail'])->name('customer.check.email');
Route::post('/registration', [CustomerController::class, 'store'])->name('customer.store');

// Authentication Routes
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('common.login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');


require __DIR__.'/auth.php';
