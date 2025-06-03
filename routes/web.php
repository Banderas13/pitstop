<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
