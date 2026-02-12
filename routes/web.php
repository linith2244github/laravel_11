<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

# Auth Router
Route::get("/login", [AuthController::class,"showLogin"])->name("auth.show.login");
Route::get("/register", [AuthController::class,"showRegister"])->name("auth.show.register");

Route::get("/product", [ProductController::class, "index"])->name("product.list");
Route::get("/product/create", [ProductController::class, "create"])->name("product.create");
Route::get("/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit");
Route::post("/product/store", [ProductController::class, "store"])->name("product.store");
Route::get("/product/{id}", [ProductController::class, "delete"])->name("product.delete");
Route::post("/product/update/{id}", [ProductController::class, "update"])->name("product.update");
Route::post("/porduct/deleteSelect", [ProductController::class,"deleteSelect"])->name("product.deleteSelect");
