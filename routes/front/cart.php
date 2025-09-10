<?php
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart_index');

Route::post('/cart/add-to-cart', [CartController::class, 'addToCart']);

