<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'getProducts'])->name('admin.products');
    Route::get('/categories', [AdminController::class, 'getCategories'])->name('admin.categories');
    Route::get('/categoryParent', [AdminController::class, 'getCategoryParents'])->name('admin.categoryparents');
    Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users');

    Route::get('/update/products/update-product/{id}', [AdminController::class, 'getidproduct'])->name('admin.updateProduct');
    Route::put('/update/products/update-product/{id}', [AdminController::class, 'updateproduct'])->name('admin.updateProductPost');
    Route::get('/update/category/update-caterogy/{id}', [AdminController::class, 'getidcategory'])->name('admin.updatecategory');
    Route::put('/update/category/update-caterogy/{id}', [AdminController::class, 'updatecategory'])->name('admin.updatecategoryPost');
    Route::get('/update/categoryParent/update-parent/{id}', [AdminController::class, 'getidcategoryParent'])->name('admin.updateParent');
    Route::put('/update/categoryParent/update-parent/{id}', [AdminController::class, 'updatecategoryParent'])->name('admin.updateParentPost');

    Route::get('/create/addproduct', [AdminController::class, 'addProduct'])->name('admin.addProduct');
    Route::post('/create/addproduct', [AdminController::class, 'storeProduct'])->name('admin.addProductPost');
    Route::get('/create/addcategory', [AdminController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('/create/addcategory', [AdminController::class, 'storeCategory'])->name('admin.addCategoryPost');
    Route::get('/create/addParent', [AdminController::class, 'addParent'])->name('admin.addParent');
    Route::post('/create/addParent', [AdminController::class, 'storeParent'])->name('admin.addParentPost');

});

Route::get('/cart', function () {
    return view('cart.index');
});

require __DIR__.'/auth.php';
