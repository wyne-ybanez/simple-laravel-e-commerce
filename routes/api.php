<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'admin'])
    ->group(function() {
        Route::get('/user', [AuthController::class, 'getUser']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/orders', OrderController::class);
        Route::get('/orders/{order}', [OrderController::class, 'view']);

        Route::delete('/orders/delete/{order}', [OrderController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);