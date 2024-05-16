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

Route::get('/', [App\Http\Controllers\FrontEnd\FrontEndController::class, 'index']);

Auth::routes();

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
