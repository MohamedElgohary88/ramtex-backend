<?php

use App\Http\Controllers\Api\Auth\ClientAuthController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['message' => 'pong'];
});

// Client Authentication Routes (Public)
Route::prefix('client')->group(function () {
    Route::post('/register', [ClientAuthController::class, 'register'])->name('client.register');
    Route::post('/login', [ClientAuthController::class, 'login'])->name('client.login');
});

// Client Authenticated Routes
Route::middleware('auth:client-api')->prefix('client')->group(function () {
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');
    Route::get('/me', [ClientAuthController::class, 'me'])->name('client.me');
    
    // Orders
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // Favorites / Wishlist
    Route::post('/favorites', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

// Product Catalog Routes (Public - No Auth Required)
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
});
