<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('register', [AuthController::class, 'register']);

// Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    // Task routes
    Route::apiResource('tasks', TaskController::class);

    // Product routes
    Route::apiResource('products', ProductController::class);

    // Logout
    // Route::post('logout', [AuthController::class, 'logout']);
});
