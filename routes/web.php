<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard utama — redirect sesuai role
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route khusus Santri
Route::middleware(['auth', 'is_santri'])->group(function () {
    Route::get('/dashboard/santri', [SantriController::class, 'index'])
        ->name('dashboard.santri');
});

// Route khusus Guru
Route::middleware(['auth', 'is_guru'])->group(function () {
    Route::get('/dashboard/guru', [GuruController::class, 'index'])
        ->name('dashboard.guru');
});

// Profile (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';