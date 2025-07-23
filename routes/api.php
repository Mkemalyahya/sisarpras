<?php

use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Api\BorrowApiController;
use App\Http\Controllers\api\ItemApiController;
use App\Http\Controllers\ReturningController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReturningApiController;
use App\Http\Controllers\Controller;

Route::post('/login', [UserApiController::class, 'login'])->name('login');

// ⬇️ Item route dibuat public (tidak butuh token)
Route::resource('items', ItemApiController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('{user}', [UserApiController::class, 'show']);
        Route::post('logout', [UserApiController::class, 'logout']);
    });

    Route::resource('borrows', BorrowApiController::class);
    Route::apiResource('returnings', ReturningApiController::class)->only(['index', 'show', 'store']);
});
