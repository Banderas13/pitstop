<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Car routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('cars', CarController::class)->except(['show', 'edit', 'update']);
    Route::get('search-brands', [CarController::class, 'searchBrands'])->name('cars.searchBrands');
    Route::get('search-models', [CarController::class, 'searchModels'])->name('cars.searchModels');
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
