<?php

use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReturningController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [UserController::class, 'auth'])->name('auth');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('locations', LocationController::class);

    Route::resource('items', ItemController::class);

    Route::resource('borrows', BorrowController::class);
    Route::prefix('borrows')->group(function () {
        Route::put('{borrow}/approve', [BorrowController::class, 'approve'])->name('borrows.approve');
        Route::put('{borrow}/reject', [BorrowController::class, 'reject'])->name('borrows.reject');
    });

    Route::resource('returnings', ReturningController::class);
});
