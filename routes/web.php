<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== ADMIN =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/hotels', [AdminController::class, 'hotels'])->name('hotels');
        Route::get('/hotels/create', [AdminController::class, 'createHotel'])->name('hotels.create');
        Route::post('/hotels', [AdminController::class, 'storeHotel'])->name('hotels.store');
        Route::get('/hotels/{hotel}/edit', [AdminController::class, 'editHotel'])->name('hotels.edit');
        Route::put('/hotels/{hotel}', [AdminController::class, 'updateHotel'])->name('hotels.update');
        Route::delete('/hotels/{hotel}', [AdminController::class, 'deleteHotel'])->name('hotels.delete');
    });
});

// ===== USER PROTECTED ROUTES =====
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/hotel/{hotel}', [HomeController::class, 'detail'])->name('hotel.detail');
    Route::post('/hotel/{hotel}/book', function () {
        return back()->with('success', 'Booking berhasil!');
    })->name('hotel.book');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/account-setting', [ProfileController::class, 'accountSetting'])->name('account.setting');
    Route::put('/account-setting', [ProfileController::class, 'updateAccount'])->name('account.update');
    Route::get('/help-center', [ProfileController::class, 'helpCenter'])->name('help.center');
});
