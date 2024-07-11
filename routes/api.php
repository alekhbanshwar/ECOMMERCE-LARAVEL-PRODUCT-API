<?php

use App\Http\Controllers\Api\ProductAttrController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImagesCOntroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::apiResource('products', ProductController::class);
// OR 
Route::get('products', [ProductController::class, 'Index']);
Route::post('products', [ProductController::class, 'store'])->name('store');
Route::get('products/{product}', [ProductController::class, 'show']);
Route::put('products/{product}', [ProductController::class, 'update'])->name('update');
Route::delete('products/{product}', [ProductController::class, 'destroy']);


Route::get('productImages/{pro_id}', [ProductImagesCOntroller::class, 'ProductImages']);
Route::post('productImages/{pro_id}', [ProductImagesCOntroller::class, "productImagesStore"])->name('productImagesStore');
Route::get('productImages/{pro_id}/{id}', [ProductImagesCOntroller::class, "productImagesShow"]);
Route::delete('productImages/{id}', [ProductImagesCOntroller::class, 'productImagesDestroy']);


Route::get('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrIndex']);
Route::post('productAttr/{pro_id}', [ProductAttrController::class, 'productAttrStore'])->name('productAttrStore');
Route::get('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrShow']);
Route::put('productAttr/{pro_id}/{id}', [ProductAttrController::class, 'productAttrUpdate'])->name('productAttrUpdate');
Route::delete('productAttr/{id}', [ProductAttrController::class, 'productAttrDestroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


