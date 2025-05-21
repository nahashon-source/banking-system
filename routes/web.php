<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankingRecordController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated group routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('banking-records', BankingRecordController::class);
});

// Public accounts route
Route::get('/accounts', [AccountController::class, 'index']);

require __DIR__.'/auth.php';
