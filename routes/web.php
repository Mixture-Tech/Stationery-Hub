<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/home/index');
});

Route::get('/san-pham', function () {
    return view('/products/index');
});

Route::get('/san-pham/chi-tiet-san-pham', function () {
    return view('/products/detail');
});

Route::get('/gio-hang', function () {
    return view('/cart/index');
});

Route::get('/thanh-toan', function() {
    return view('/payment/index');
});

Route::get('/thanh-toan-thanh-cong', function () {
    return view('/payment/success');
});