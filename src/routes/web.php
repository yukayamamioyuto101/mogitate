<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// 商品一覧ページ（検索・並び替え用）
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品詳細ページ
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');

Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/register', [ProductController::class, 'create'])->name('products.register');


Route::post('/products/confirm', [ProductController::class, 'confirm'])->name('products.confirm');

Route::post('/products/create', [ProductController::class, 'store'])->name('products.create');




