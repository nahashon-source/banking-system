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

//only one resource route for accounts
Route::middleware('auth')->group(function () {
    Route::resource('accounts', AccountController::class); // this covers all account routes

});

require __DIR__.'/auth.php';