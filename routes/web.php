<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function(){
    return view('welcome');
});

Route::get('products', [HomeController::class, 'index']);
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products/create', [ProductController::class, 'store']);
Route::get('products/{id}/edit', [ProductController::class, 'edit']);
Route::put('products/{id}/edit', [ProductController::class, 'update']);
Route::get('products/{id}/delete', [ProductController::class, 'destroy']);
Route::get('products/search', [ProductController::class, 'search'])->name('products.search');