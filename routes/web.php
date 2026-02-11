<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get("/product", [ProductController::class, "index"])->name("product.list");
Route::get("/product/create", [ProductController::class, "create"])->name("product.create");
Route::get("/product/edit", [ProductController::class, "edit"])->name("product.edit");
Route::post("/product/store", [ProductController::class, "store"])->name("product.store");
Route::get("/product/{id}", [ProductController::class, "delete"])->name("product.delete");