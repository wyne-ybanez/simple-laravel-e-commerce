<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/monsters', [ProductController::class, 'monsters'])->name('monsters');
Route::get('/heroes', [ProductController::class, 'heroes'])->name('heroes');
Route::get('/anti-heroes', [ProductController::class, 'anti_heroes'])->name('anti_heroes');
Route::get('/landscapes', [ProductController::class, 'landscapes'])->name('landscapes');

Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
