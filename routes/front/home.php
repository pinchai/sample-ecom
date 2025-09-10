<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/getById', [HomeController::class, 'getById']);

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout_index');
