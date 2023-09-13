<?php

use App\Http\Controllers\CustomerController; // Adjust the namespace if necessary
use App\Http\Controllers\InvoiceController;  // Adjust the namespace if necessary
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::resource('customers', CustomerController::class);
    Route::resource('invoices', InvoiceController::class);
});
