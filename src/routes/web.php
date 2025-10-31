<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// 商品登録フロー
Route::get('/products/register', [ProductController::class, 'create'])->name('products.register');
Route::post('/products/confirm', [ProductController::class, 'confirm'])->name('products.confirm');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

// 商品更新・削除
Route::put('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

// 商品一覧・詳細ページ（GETは最後）
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');





