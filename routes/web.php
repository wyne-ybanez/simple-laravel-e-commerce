<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guestOrVerified'])->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/monsters', [ProductController::class, 'category1'])->name('monsters');
    Route::get('/anti-heroes', [ProductController::class, 'category2'])->name('anti_heroes');
    Route::get('/heroes', [ProductController::class, 'category3'])->name('heroes');
    Route::get('/landscapes', [ProductController::class, 'category4'])->name('landscapes');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::prefix('/cart')->name('cart.')->group(Function() {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
