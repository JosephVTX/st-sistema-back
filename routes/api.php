<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', fn() => response()->json(['message' => 'Hello World!']));

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});

require __DIR__ . '/auth.php';  