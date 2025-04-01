<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::get('/categories', [AdminController::class, 'getCategories'])->name('admin.categories');
    Route::get('/categoryParent', [AdminController::class, 'getCategoryParents'])->name('admin.categoryparents');
    Route::get('/orders', [AdminController::class, 'getOrders'])->name('admin.orders');
    Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users');

    Route::get('/update/products/update-product/{id}', [AdminController::class, 'getidproduct'])->name('admin.updateProduct');
    Route::put('/update/products/update-product/{id}', [AdminController::class, 'updateproduct'])->name('admin.updateProductPost');
    Route::get('/update/category/update-caterogy/{id}', [AdminController::class, 'getidcategory'])->name('admin.updatecategory');
    Route::put('/update/category/update-caterogy/{id}', [AdminController::class, 'updatecategory'])->name('admin.updatecategoryPost');
    Route::get('/update/categoryParent/update-parent/{id}', [AdminController::class, 'getidcategoryParent'])->name('admin.updateParent');
    Route::put('/update/categoryParent/update-parent/{id}', [AdminController::class, 'updatecategoryParent'])->name('admin.updateParentPost');
    Route::get('/update/orders/update-order/{id}', [AdminController::class, 'getidorder'])->name('admin.updateOrder');
    Route::put('/update/orders/update-order/{id}', [AdminController::class, 'updateorder'])->name('admin.updateOrderPost');
    Route::get('/update/users/update-user/{id}', [AdminController::class, 'getiduser'])->name('admin.updateUser');
    Route::put('/update/users/update-user/{id}', [AdminController::class, 'updateuser'])->name('admin.updateUserPost');

    Route::get('/create/addproduct', [AdminController::class, 'addProduct'])->name('admin.addProduct');
    Route::post('/create/addproduct', [AdminController::class, 'storeProduct'])->name('admin.addProductPost');
    Route::get('/create/addcategory', [AdminController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('/create/addcategory', [AdminController::class, 'storeCategory'])->name('admin.addCategoryPost');
    Route::get('/create/addParent', [AdminController::class, 'addParent'])->name('admin.addParent');
    Route::post('/create/addParent', [AdminController::class, 'storeParent'])->name('admin.addParentPost');

});