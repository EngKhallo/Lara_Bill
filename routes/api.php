<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController; // Adjust the namespace if necessary
use App\Http\Controllers\InvoiceController;  // Adjust the namespace if necessary
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
    Route::apiResource('customers', CustomerController::class)->except(['index', 'show']);
    Route::apiResource('invoices', InvoiceController::class)->except(['index', 'show']);
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
});

// Public routes
Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('customers', CustomerController::class)->only(['index', 'show']);
    Route::apiResource('invoices', InvoiceController::class)->only(['index', 'show']);
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::post('/register', [AuthController::class, 'register']);
});