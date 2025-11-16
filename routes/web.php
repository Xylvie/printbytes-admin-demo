<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', function () {
    return view('./auth/login');
});

Route::middleware( 'auth')->prefix('dashboard')->group(function () {
    Route::get('/', [SalesController::class, 'index'])->name('dashboard');
    Route::get('/sales', [SalesController::class, 'create'])->name('update-sales');
    Route::get('/expenses', [ExpensesController::class, 'create'])->name('update-expenses');
    Route::get('/partition', [ExpensesController::class, 'index'])->name('partitions');

    Route::post('/sales/update', [SalesController::class, 'store'])->name('sales-updated');
    Route::post('/expenses/update', [ExpensesController::class, 'store'])->name('expenses-updated');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
