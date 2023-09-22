<?php

use App\Http\Controllers\CustomerController; // Adjust the namespace if necessary
use App\Http\Controllers\InvoiceController;  // Adjust the namespace if necessary
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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
});