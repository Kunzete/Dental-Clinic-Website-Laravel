<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/Product/createProduct', [productController::class, 'CP'])->name('createProd');
Route::post('/Product/createProduct', [productController::class, 'store'])->name('store');
Route::get('/Product/listProduct', [productController::class, 'show'])->name('show');
Route::get('/Product/listProduct/{id}', [productController::class, 'destroy'])->name('delete');
Route::get('/Product/editProduct/{id}', [productController::class, 'edit'])->name('edit');
Route::post('/Product/editProduct/{id}', [productController::class, 'update'])->name('update');
