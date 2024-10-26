<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Show products
Route::get('products', [HomeController::class, 'index']);
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products/create', [ProductController::class, 'store']);
Route::get('products/{id}/edit', [ProductController::class, 'edit']);
Route::put('products/{id}/edit', [ProductController::class, 'update']);
Route::delete('products/{id}/delete', [ProductController::class, 'destroy']);
Route::get('products/search', [ProductController::class, 'search'])->name('products.search');


// Show the cart
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show'); // Show cart
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add'); // Add item to cart
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update'); // Update cart item
Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove'); // Remove item from cart
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Remove item from cart




Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
