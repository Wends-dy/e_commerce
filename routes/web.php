<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('products', [HomeController::class, 'index']);
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products/create', [ProductController::class, 'store']);
Route::get('products/{id}/edit', [ProductController::class, 'edit']);
Route::put('products/{id}/edit', [ProductController::class, 'update']);
Route::delete('products/{id}/delete', [ProductController::class, 'destroy']);
Route::get('products/search', [ProductController::class, 'search'])->name('products.search');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin', [AdminDashboardController::class, 'index']);
    Route::get('admin/create', [AdminDashboardController::class, 'create']);
    Route::post('admin/create', [AdminDashboardController::class, 'store']);
    Route::get('admin/{id}/edit', [AdminDashboardController::class, 'edit']);
    Route::put('admin/{id}/edit', [AdminDashboardController::class, 'update']);
    Route::delete('admin/{id}/delete', [AdminDashboardController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
