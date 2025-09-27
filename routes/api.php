<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController; 
use App\Http\Controllers\Api\ProductController;  

// --- AUTHENTICATION ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- PUBLIC ROUTES ---
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// --- PROTECTED ROUTES (Requires a valid token) ---
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Admin-only routes for Categories
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('is_admin');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('is_admin');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('is_admin');

    // Admin-only routes for Products
    Route::post('/products', [ProductController::class, 'store'])->middleware('is_admin');
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('is_admin');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('is_admin');
});