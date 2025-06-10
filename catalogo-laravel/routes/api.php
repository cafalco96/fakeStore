<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthControler;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('productos',ProductoController::class);

//Rutas publicas
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::post('register', [AuthControler::class, 'register']);
Route::post('login', [AuthControler::class, 'login']);

//Rutas privadas
Route::middleware('auth:sanctum')->group(
    function () {
        Route::post('logout', [AuthControler::class, 'logout']);

        Route::middleware('is_admin')->group(function () {
            Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
            Route::post('/productos', [ProductoController::class, 'store']);
            Route::put('/productos/{id}', [ProductoController::class, 'update']);
        });
    }
);