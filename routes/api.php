<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DashboardController;
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
    ->group(function () {
        // User Routes
        Route::get('/user', [AuthController::class, 'getUser']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // API resources
        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/customers', CustomerController::class);
        Route::apiResource('/orders', OrderController::class);
        Route::get('/countries', [CustomerController::class, 'countries']);

        // Orders Routes
        Route::get('/orders/statuses', [OrderController::class, 'getStatuses']);
        Route::post('/orders/change-status/{order}/{status}', [OrderController::class, 'changeStatus']);
        Route::get('/orders/{order}', [OrderController::class, 'view']);
        Route::delete('/orders/delete/{order}', [OrderController::class, 'destroy']);

        // Dashboard Routes
        Route::get('/dashboard/customers-count', [DashboardController::class, 'activeCustomers']);
        Route::get('/dashboard/products-count', [DashboardController::class, 'activeProducts']);
        Route::get('/dashboard/orders-count', [DashboardController::class, 'paidOrders']);
        Route::get('/dashboard/income-amount', [DashboardController::class, 'totalIncome']);
});

// Login
Route::post('/login', [AuthController::class, 'login']);
