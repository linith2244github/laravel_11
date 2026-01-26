<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get("/product", [ProductController::class, "index"]);
Route::get("/product/create", [ProductController::class, "create"]);
Route::get("/product/edit", [ProductController::class, "edit"]);
Route::post("/product/store", [ProductController::class, "store"])->name("product.store");