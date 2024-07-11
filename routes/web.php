<?php

use App\Http\Controllers\Api\ProductAttrController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductImagesCOntroller;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, "Product"])->name('products.index');

Route::get('/ManageProduct', [ProductController::class, "ManageProduct"]);
Route::get('/ManageProduct/{id}', [ProductController::class, 'ManageProduct']);
Route::get('/ProductView/{id}', [ProductController::class, "ProductView"]);

Route::get('/ManageProductImages/{pro_id}', [ProductImagesCOntroller::class, "ManageProductImages"])->name("ManageProductImages.Index");

Route::get('/ManageProductAttr/{pro_id}', [ProductAttrController::class, "ManageProductAttr"])->name('ManageProductAttr.Index');
Route::get('/ManageProductAttr/{pro_id}/{id}', [ProductAttrController::class, "ManageProductAttr"]);

