<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
Route::get('/', fn() => response()->json(['message' => 'Hello World!']));

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

   
});


Route::group(['prefix' => 'artisan'], function () { 
    Route::get('/migrate', function (Request $request) {
        
        // Obtener APP_KEY del entorno
        $APP_KEY = env('APP_KEY');
        
        // Extraer los últimos 16 caracteres de APP_KEY
        $appKeyLast16 = substr($APP_KEY, -16);
        
        // Extraer los últimos 16 caracteres del input
        $requestKeyLast16 = substr($request->input('APP_KEY'), -16);
        
        // Comparar solo los últimos 16 caracteres
        if ($appKeyLast16 !== $requestKeyLast16) {
            return response()->json(['message' => 'APP_KEY is not correct']);
        }

        Artisan::call('migrate:fresh --seed');

        return response()->json(['message' => 'Database migrated and seeded successfully']);
    });
    Route::get('/storage:link', function (Request $request) {
        $APP_KEY = env('APP_KEY');
        
        // Extraer los últimos 16 caracteres de APP_KEY
        $appKeyLast16 = substr($APP_KEY, -16);
        
        // Extraer los últimos 16 caracteres del query parameter
        $requestKeyLast16 = substr($request->query('APP_KEY'), -16);
        
        // Comparar solo los últimos 16 caracteres
        if ($appKeyLast16 !== $requestKeyLast16) {
            return response()->json(['message' => 'APP_KEY is not correct']);
        }

        Artisan::call('storage:link');
        return response()->json(['message' => 'Storage linked successfully']);
    });
});


require __DIR__ . '/auth.php';  