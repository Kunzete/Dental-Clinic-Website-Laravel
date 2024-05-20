<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/Agent/createAgent', [HomeController::class, 'CA'])->name('createAgent');
Route::get('/Agent/listAgent', [HomeController::class, 'LA'])->name('listAgent');
Route::get('/Product/createProduct', [productController::class, 'CP'])->name('createProduct');
Route::post('/Product/createProduct', [productController::class, 'store'])->name('createProduct.store');
Route::get('/Product/listProduct', [productController::class, 'show'])->name('listProduct');
