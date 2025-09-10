<?php
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart_index');

Route::post('/cart/add-to-cart', [CartController::class, 'addToCart']);
Route::post('/cart/remove', [CartController::class, 'removeCart'])
    ->name('cart_remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])
    ->name('cart_update');

