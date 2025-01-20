<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsManager;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\OrderManager;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductsManager::class, 'index'])->name('products');

Route::get('/hello-world', [HelloWorldController::class, 'index']);

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::get('/register', [AuthManager::class, 'register'])->name('register');

Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('products/{slug}', [ProductsManager::class, 'show'])->name('products.details');

Route::middleware('auth')->group(function () {
    Route::get('/cart/{id}', [ProductsManager::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ProductsManager::class, 'showCart'])->name('cart.show');
    Route::get('/checkout', [OrderManager::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout', [OrderManager::class, 'checkoutPost'])->name('checkout.post');
});
