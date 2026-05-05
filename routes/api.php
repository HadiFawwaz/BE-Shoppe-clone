<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// Jalur Publik (Gak perlu login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);
// Jalur Dilindungi (Wajib pakai Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout', [ProductController::class, 'checkout']);
    Route::get('/history', [ProductController::class, 'history']); 
    Route::put('/profile', [ProductController::class, 'updateProfile']); 
    Route::post('/logout', [AuthController::class, 'logout']); 
});