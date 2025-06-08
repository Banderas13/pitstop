<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/uploads', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
