<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VraagController;

Route::post('/vraag-versturen', [VraagController::class, 'verstuur'])->name('vraag.verstuur');

Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Car routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('cars', CarController::class)->except(['show', 'edit', 'update']);
    Route::get('search-brands', [CarController::class, 'searchBrands'])->name('cars.searchBrands');
    Route::get('search-models', [CarController::class, 'searchModels'])->name('cars.searchModels');
});

// Mechanic routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::resource('mechanics', MechanicController::class);
});

// Service page route
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/create/step2', [ServiceController::class, 'createStep2'])->name('service.create.step2');
    Route::post('/service/create/step2', [ServiceController::class, 'storeStep2'])->name('service.store.step2');
    Route::get('/service/create/step3', [ServiceController::class, 'createStep3'])->name('service.create.step3');
    Route::post('/service/create/step3', [ServiceController::class, 'storeStep3'])->name('service.store.step3');
    Route::get('/service/create/step4', [ServiceController::class, 'createStep4'])->name('service.create.step4');
    Route::post('/service/create/step4', [ServiceController::class, 'storeStep4'])->name('service.store.step4');
    Route::get('/service/create/step5', [ServiceController::class, 'createStep5'])->name('service.create.step5');
    Route::post('/service/create/step5', [ServiceController::class, 'storeStep5'])->name('service.store.step5');
    Route::get('/service/user-cars', [ServiceController::class, 'getUserCars'])->name('service.user-cars');
    Route::get('/service/get-user-data', [ServiceController::class, 'getUserData'])->name('service.get-user-data');
    Route::get('/service/get-car-data', [ServiceController::class, 'getCarData'])->name('service.get-car-data');
    Route::get('/service/{case}', [ServiceController::class, 'show'])->name('service.show');
    Route::patch('/service/{case}/approve', [ServiceController::class, 'approve'])->name('service.approve');
});

// Account routes (require authentication)
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::resource('account', AccountController::class);
});

// Simple view routes for authenticated users
Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::get('/account', [ProfileController::class, 'index'])->name('account.index');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
    Route::get('/mechanics/search', [MechanicController::class, 'search'])->name('mechanics.search');
    Route::post('/mechanics/add/{id}', [MechanicController::class, 'addToContacts'])->name('mechanics.add');
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:web,mechanic'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update.name');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');
});

Route::get('/contact', function(){
    return view('contact');
  })->name('contact');

Route::get('/about', function () {
    return view('about');
});

// Protected routes that require email verification
Route::middleware(['auth:web,mechanic', 'verified'])->group(function () {
    // User routes
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/mechanics', [MechanicController::class, 'index'])->name('mechanics.index');
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth:web,mechanic'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    // Store the current guard and user type before verification
    $isMechanic = auth()->guard('mechanic')->check();
    $userType = session('user_type');
    
    $request->fulfill();
    
    if ($isMechanic) {
        // Get the mechanic instance
        $mechanic = \App\Models\Mechanic::find($request->route('id'));
        
        // Log in the mechanic
        auth()->guard('mechanic')->login($mechanic);
        session()->put('user_type', 'mechanic');
        
        return redirect('/')->with('success', 'Uw e-mail is geverifieerd!');
    }
    
    return redirect('/')->with('success', 'Uw e-mail is geverifieerd!');
})->middleware(['auth:web,mechanic', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if (auth()->guard('mechanic')->check()) {
        auth()->guard('mechanic')->user()->sendEmailVerificationNotification();
    } else {
        auth()->user()->sendEmailVerificationNotification();
    }
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth:web,mechanic', 'throttle:6,1'])->name('verification.send');
