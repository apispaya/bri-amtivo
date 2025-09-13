<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
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

    // Clients
    Route::get('/clients',              [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create',       [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients',             [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}',     [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}',  [ClientController::class, 'destroy'])->name('clients.destroy');

    // Certification 
    Route::get('/client-certifications',               [ClientController::class, 'index'])->name('client-certs.index');
    Route::put('/client-certifications/{client}',      [ClientController::class, 'update'])->name('client-certs.update');
    Route::delete('/client-certifications/{client}',   [ClientController::class, 'destroy'])->name('client-certs.destroy');

    // Assessment
    Route::get('/client-assessments',           [ClientController::class, 'assessments'])->name('client-assessments');
    Route::put('/clients/{client}/assessment',  [ClientController::class, 'updateAssessment'])->name('clients.assessment.update');

    // Training-Segment
    Route::get('/training-segments',            [ClientController::class, 'trainingIndex'])->name('clients.training.index');
    Route::put('/clients/{client}/training',    [ClientController::class, 'updateTraining'])->name('clients.training.update');

    Route::get('/endorsements',         [ClientController::class, 'isoIndex'])->name('clients.iso.index');
    Route::put('/clients/{client}/iso', [ClientController::class, 'updateIso'])->name('clients.iso.update');
});


Route::get('/dashboard/kosong', function () {
    return view('dashboard.kosong');
})->name('dashboard.kosong');

// Route::get('/dashboard/endorsement', function () {
//     return view('dashboard.endorsement');
// })->name('dashboard.endorsement');
