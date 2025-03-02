<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', fn() => response()->json(['message' => 'Hello World!']));

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::group(['prefix' => 'artisan'], function () {
        Route::get('/migrate', function () {
            Artisan::call('migrate:fresh --seed');
            return response()->json(['message' => 'Database migrated and seeded successfully']);
        });
        Route::get('/storage:link', function () {
            Artisan::call('storage:link');
            return response()->json(['message' => 'Storage linked successfully']);
        });
    });
});



require __DIR__ . '/auth.php';  