<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Home page route
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route to view all services
Route::get('/services/all', [HomeController::class, 'services'])->name('services.all');

// Guest users (not logged in)
Route::middleware(['guest'])->group(function () {
    // Login page
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    // Login form submission
    Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');
    // Registration page
    Route::get('/register', [HomeController::class, 'register'])->name('register');
    // Registration form submission
    Route::post('/register', [UserController::class, 'registerPost'])->name('register.post');
});

// Authenticated users (logged in)
Route::middleware(['auth'])->group(function () {
    // View profile page
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    // Edit profile page
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    // Update profile information
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Show list of services
    Route::get('/services', [ServiceController::class, 'showServices'])->name('services');
    // Create new service form
    Route::get('/services/create', [ServiceController::class, 'createService'])->name('services.create');
    // Submit new service
    Route::post('/services/create', [ServiceController::class, 'createServicePost'])->name('services.create.post');
    // Edit existing service
    Route::get('/services/{id}/edit', [ServiceController::class, 'editService'])->name('services.edit');
    // Update service details
    Route::post('/services/{id}/update', [ServiceController::class, 'updateService'])->name('services.update');
    // Delete service
    Route::delete('/services/{id}', [ServiceController::class, 'deleteService'])->name('services.delete');
});
