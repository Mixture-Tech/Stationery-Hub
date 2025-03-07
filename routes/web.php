<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/home/index');
});
Route::get('/dang-nhap', function () {
    return view('/auth/login');
})->name('login');
Route::get('/dang-ky', function () {
    return view('/auth/register');
})->name('register');
Route::get('/quen-mat-khau', function () {
    return view('/auth/forgotpassword');
})->name('forgotpassword');