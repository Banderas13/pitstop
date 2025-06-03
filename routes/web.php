<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/admin', function () {
    return 'Welkom admin!';
})->middleware(IsAdmin::class);
