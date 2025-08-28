<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ProductController;


Route::apiResource('tasks', TaskController::class);
Route::post('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::post('tasks/{task}/incomplete', [TaskController::class, 'incomplete'])->name('tasks.incomplete');

// Product routes
Route::apiResource('products', ProductController::class);
