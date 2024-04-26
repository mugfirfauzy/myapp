<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AdditionalController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CallbackController;
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
Route::post('/updatefcmid', [AuthController::class, 'updateFcmId'])->middleware('auth:sanctum');

// CATEGORY FUNCTION
Route::get('/category', [CategoryController::class, 'index']);

// PRODUCT FUNCTION
Route::get('/product', [ProductController::class, 'index']);

// GET ADDRESS FUNCTION
// Route::get('/addresses', [ProductController::class, 'index'])->middleware('auth:sanctum');
Route::apiResource('addresses', AddressController::class)->middleware('auth:sanctum');

Route::post('/setdefaultaddress', [AdditionalController::class, 'setdefaultaddress'])->middleware('auth:sanctum');

Route::post('/order', [OrderController::class, 'order'])->middleware('auth:sanctum');
Route::get('/order/order/{id}', [OrderController::class, 'getOrderById'])->middleware('auth:sanctum');
Route::get('/order/status/{id}', [OrderController::class, 'getStatusOrderById'])->middleware('auth:sanctum');
Route::get('/order/getorder', [OrderController::class, 'getOrder'])->middleware('auth:sanctum');
Route::get('/order/getwholeorder', [OrderController::class, 'getWholeOrder'])->middleware('auth:sanctum');

Route::post('/callback', [CallbackController::class, 'callback']);


