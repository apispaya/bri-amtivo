<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientCertificationController;

// Landing: send guests to login, signed-in users to dashboard home
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard.home')
        : redirect()->route('login');
});

// Auth (guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

// Logout (auth only)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard (auth only)
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    // Dashboard home
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    // Users
    Route::get('/user-list',        [UserController::class, 'index'])->name('users.index');
    Route::post('/users',           [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}',     [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',  [UserController::class, 'destroy'])->name('users.destroy');

    // Client Certifications
    Route::get('/client-certifications',              [ClientCertificationController::class, 'index'])->name('client-certs.index');
    Route::post('/client-certifications',             [ClientCertificationController::class, 'store'])->name('client-certs.store');
    Route::put('/client-certifications/{cert}',       [ClientCertificationController::class, 'update'])->name('client-certs.update');
    Route::delete('/client-certifications/{cert}',    [ClientCertificationController::class, 'destroy'])->name('client-certs.destroy');
});


Route::get('/dashboard/kosong', function () {
    return view('dashboard.kosong');
})->name('dashboard.kosong');

Route::get('/dashboard/client-assessments', function () {
    return view('dashboard.client-assessments');
})->name('dashboard.client-assessments');
