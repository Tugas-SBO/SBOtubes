<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - StayQ Hotel Booking App
|--------------------------------------------------------------------------
*/

// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== PROTECTED ROUTES =====
Route::middleware('auth')->group(function () {

    // Home / Main Menu
    Route::get('/', function () {
        return redirect()->route('profile');
    });

    // Profile page (main menu)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Account Setting
    Route::get('/account-setting', [ProfileController::class, 'accountSetting'])->name('account.setting');
    Route::put('/account-setting', [ProfileController::class, 'updateAccount'])->name('account.update');

    // Help Center
    Route::get('/help-center', [ProfileController::class, 'helpCenter'])->name('help.center');
});
