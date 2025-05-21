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
Route::get('/accounts', [AccountController::class, 'index']); //List all accounts
Route::get('/accounts', [AccountController::class, 'store']); // Create new account
Route::put('accounts/{id}', [AccountController::class, 'update']); // Update account
Route::delete('accounts/{id}', [AccountController::class, 'destroy']); // Delete account

require __DIR__.'/auth.php';
