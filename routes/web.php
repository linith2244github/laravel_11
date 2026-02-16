<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\MiddlewareAccess;
use Illuminate\Support\Facades\Route;

// Route::group(["prefix"=> "admin"], function () {});
Route::prefix("admin")->group(function () {
    # Auth Router
    Route::get("/", [AuthController::class,"showLogin"])->name("auth.show.login");
    Route::post("/login/process", [AuthController::class,"processLogin"])->name("auth.login.process");
    Route::get("/register", [AuthController::class,"showRegister"])->name("auth.show.register");
    Route::post("/register/process", [AuthController::class,"processRegister"])->name("auth.register.process");

    //Middleware group
    Route::middleware(MiddlewareAccess::class)->group(function(){
        Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout");
    // Route with controler
        Route::get("/product", [ProductController::class, "index"])->name("product.list");
        Route::get("/product/create", [ProductController::class, "create"])->name("product.create");
        Route::get("/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit");
        Route::post("/product/store", [ProductController::class, "store"])->name("product.store");
        Route::get("/product/{id}", [ProductController::class, "delete"])->name("product.delete");
        Route::post("/product/update/{id}", [ProductController::class, "update"])->name("product.update");
        Route::post("/porduct/deleteSelect", [ProductController::class,"deleteSelect"])->name("product.deleteSelect");
    });
    // or Route::group(MiddlewareAccess::class, function(){});
    
    // Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout")->middleware(MiddlewareAccess::class);
    
    // Route with controler
    // Route::get("/product", [ProductController::class, "index"])->name("product.list")->middleware(MiddlewareAccess::class);
    // Route::get("/product/create", [ProductController::class, "create"])->name("product.create")->middleware(MiddlewareAccess::class);
    // Route::get("/product/edit/{id}", [ProductController::class, "edit"])->name("product.edit")->middleware(MiddlewareAccess::class);
    // Route::post("/product/store", [ProductController::class, "store"])->name("product.store")->middleware(MiddlewareAccess::class);
    // Route::get("/product/{id}", [ProductController::class, "delete"])->name("product.delete")->middleware(MiddlewareAccess::class);
    // Route::post("/product/update/{id}", [ProductController::class, "update"])->name("product.update")->middleware(MiddlewareAccess::class);
    // Route::post("/porduct/deleteSelect", [ProductController::class,"deleteSelect"])->name("product.deleteSelect")->middleware(MiddlewareAccess::class);
});