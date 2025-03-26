<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'detail'])->name('products.detail');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/remove-multiple', [CartController::class, 'removeMultiple'])->name('cart.remove.multiple');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
});

Route::get('/payment', function () {
    return view('payment.index');
});

Route::get('/payment/success', function () {
    return view('payment.success');
});

require __DIR__.'/auth.php';
