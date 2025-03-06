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