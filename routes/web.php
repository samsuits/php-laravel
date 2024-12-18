<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsManager;
use App\Http\Controllers\HelloWorldController;

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