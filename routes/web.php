<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VnpayPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Middleware\PreventAdminFromOrdering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'detail'])->name('products.detail');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Cart routes
Route::middleware(['auth', PreventAdminFromOrdering::class])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/remove-multiple', [CartController::class, 'removeMultiple'])->name('cart.remove.multiple');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
});

// Payment routes
Route::middleware(['auth', PreventAdminFromOrdering::class])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/direct', [PaymentController::class, 'directPayment'])->name('payment.direct');
    Route::post('/payment/cart', [PaymentController::class, 'cartPayment'])->name('payment.cart');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success/{order_id}', [PaymentController::class, 'success'])->name('payment.success');
    Route::post('/payment/momo/ipn', [PaymentController::class, 'ipn'])->name('payment.momo.ipn');
    Route::get('/payment/momo/callback', [PaymentController::class, 'momoCallback'])->name('payment.momo.callback');
    Route::post('/payment/vnpay/ipn', [VnpayPaymentController::class, 'ipn'])->name('payment.vnpay.ipn');
    Route::get('/payment/vnpay/callback', [VnpayPaymentController::class, 'callback'])->name('payment.vnpay.callback');
});

// Order routes
Route::middleware(['auth', PreventAdminFromOrdering::class])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
    Route::patch('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::patch('/orders/{id}/hide', [OrderController::class, 'hide'])->name('orders.hide');
});

// Google login routes
Route::middleware('guest')->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

// Debug routes
Route::get('/debug-session', fn() => session()->all());
Route::get('/debug-user', fn() => Auth::check() ? Auth::user() : "Chưa đăng nhập");

require __DIR__.'/auth.php';
