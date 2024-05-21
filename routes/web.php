<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MyTransactionController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\FrontEnd\FrontEndController;

Route::get('/', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'index']);
Route::get('/detail-product/{slug}', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'detailProduct'])->name('detail.product');
Route::get('/detail-category/{slug}', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'detailCategory'])->name('detail.category');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/cart', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'cart'])->name('cart');
    Route::post('/addCart/{id}', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'addToCart'])->name('cart.add');
    Route::delete('/deleteCart/{id}', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'deleteCart'])->name('cart.delete');
    Route::post('/checkout', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'checkout'])->name('checkout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-user', [\App\Http\Controllers\Admin\DashboardController::class, 'listUser'])->name('list-user');
    Route::resource('/category', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('/product', ProductController::class);
    Route::resource('/product.gallery', ProductGalleryController::class)->except(['create', 'show', 'edit', 'update']);
    Route::put('/list-user/{id}', [DashboardController::class, 'resetPassword'])->name('resetPassword');
    Route::resource('/my-transaction', MyTransactionController::class)->only(['index', 'show']);
    Route::resource('/transaction', TransactionController::class);
});

Route::name('user.')->prefix('user')->middleware('user')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [\App\Http\Controllers\User\DashboardController::class, 'changePassword'])->name('changePassword');
    Route::put('/update-password', [DashboardController::class, 'updatePassword'])->name('update-password');
    Route::resource('/my-transaction', MyTransactionController::class)->only(['index', 'show']);
});
