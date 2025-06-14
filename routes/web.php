<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Car routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('cars', CarController::class)->except(['show', 'edit', 'update']);
    Route::get('search-brands', [CarController::class, 'searchBrands'])->name('cars.searchBrands');
    Route::get('search-models', [CarController::class, 'searchModels'])->name('cars.searchModels');
});

// Case routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('cases', CaseController::class);
});

// Mechanic routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('mechanics', MechanicController::class);
});

// Service page route
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::view('/service', 'service')->name('service.index');
});

// Account routes (require authentication)
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::resource('account', AccountController::class);
});

// Simple view routes for authenticated users
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::view('/mechanics', 'mechanics')->name('mechanics.index');
    Route::get('/account', [ProfileController::class, 'index'])->name('account.index');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update.name');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
});
