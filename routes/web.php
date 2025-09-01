<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; // Controller for user-facing event actions
use App\Http\Controllers\Admin\EventController as AdminEventController; // Controller for admin event actions
use App\Http\Controllers\RegistrationController; // Controller for user registrations
use App\Http\Controllers\DashboardController; // Dedicated Dashboard Controller
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAdmin;

// Public Routes (Everyone can access)
Route::get('/', [EventController::class, 'index'])->name('home'); // Homepage shows upcoming events
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show'); // Show single event details

// Authenticated User Routes (Must be logged in)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard handled by controller

    Route::get('/my-registrations', [RegistrationController::class, 'index'])->name('registrations.my'); // View registered events
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register'); // Register for an event
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy'); // Cancel registration (optional)

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (Must be logged in AND be an admin)
Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Resource controller for Events (CRUD)
    Route::resource('events', AdminEventController::class);

    // Route to view registrations for a specific event
    Route::get('/events/{event}/registrations', [AdminEventController::class, 'showRegistrations'])->name('events.registrations');
});

// Authentication Routes
require __DIR__.'/auth.php';
