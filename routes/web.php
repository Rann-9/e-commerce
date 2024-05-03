<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('/product', ProductController::class);
});

Route::name('user.')->prefix('user')->middleware('user')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
});
