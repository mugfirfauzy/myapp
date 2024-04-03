<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GET CURRENT USER DATA
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// AUTH FUNCTION
Route::post('/register', [AuthController::class,'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

// CATEGORY FUNCTION
Route::get('/category', [CategoryController::class, 'index']);

// PRODUCT FUNCTION
Route::get('/product', [ProductController::class, 'index']);
