<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\AddOnController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Redirect based on role
    if ($user->role === 'Admin' || $user->role === 'Staff') {
        return view('dashboard.admin');
    } else {
        return view('dashboard.customer');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================
// ADMIN & STAFF ROUTES
// =====================================================
Route::middleware(['auth', 'role:Admin,Staff'])->group(function () {
    
    // Customers Management
    Route::resource('customers', CustomerController::class);
    
    // Employees Management (Admin only)
    Route::middleware('role:Admin')->group(function () {
        Route::resource('employees', EmployeeController::class);
    });
    
    // Pets Management
    Route::resource('pets', PetController::class);
    
    // Room Types Management
    Route::resource('roomtypes', RoomTypeController::class);
    
    // Rooms Management
    Route::resource('rooms', RoomController::class);
    Route::get('rooms/available', [RoomController::class, 'available'])->name('rooms.available');
    
    // Add-ons Management
    Route::resource('addons', AddOnController::class);
    
    // Bookings Management
    Route::resource('bookings', BookingController::class);
    Route::patch('bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::patch('bookings/{id}/verify', [BookingController::class, 'verify'])->name('bookings.verify');
    
    // Payments Management - Specific routes MUST come before resource routes
    Route::get('payments/select-booking', [PaymentController::class, 'selectBooking'])->name('payments.selectBooking');
    Route::get('payments/create/{bookingID}', [PaymentController::class, 'create'])->name('payments.createForBooking');
    Route::resource('payments', PaymentController::class);
});

// =====================================================
// CUSTOMER ROUTES
// =====================================================
Route::middleware(['auth', 'role:Customer'])->group(function () {
    
    // Customer can view their own profile
    Route::get('my-profile', [CustomerController::class, 'show'])->name('customer.profile');
    
    // Customer can manage their own pets
    Route::get('my-pets', [PetController::class, 'index'])->name('customer.pets.index');
    Route::get('my-pets/create', [PetController::class, 'create'])->name('customer.pets.create');
    Route::post('my-pets', [PetController::class, 'store'])->name('customer.pets.store');
    Route::get('my-pets/{id}', [PetController::class, 'show'])->name('customer.pets.show');
    Route::get('my-pets/{id}/edit', [PetController::class, 'edit'])->name('customer.pets.edit');
    Route::put('my-pets/{id}', [PetController::class, 'update'])->name('customer.pets.update');
    Route::delete('my-pets/{id}', [PetController::class, 'destroy'])->name('customer.pets.destroy');
    
    // Customer can browse available rooms
    Route::get('browse-rooms', [RoomController::class, 'available'])->name('customer.rooms.browse');
    
    // Customer can create bookings
    Route::get('my-bookings', [BookingController::class, 'index'])->name('customer.bookings.index');
    Route::get('my-bookings/create', [BookingController::class, 'create'])->name('customer.bookings.create');
    Route::post('my-bookings', [BookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('my-bookings/{id}', [BookingController::class, 'show'])->name('customer.bookings.show');
    
    // Customer can view their payments and make payments
    Route::get('my-payments', [PaymentController::class, 'index'])->name('customer.payments.index');
    Route::get('my-payments/create/{bookingID}', [PaymentController::class, 'customerCreate'])->name('customer.payments.create');
    Route::post('my-payments', [PaymentController::class, 'customerStore'])->name('customer.payments.store');
});

require __DIR__.'/auth.php';
