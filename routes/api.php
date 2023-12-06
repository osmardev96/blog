<?php

use App\Http\Controllers\EntradaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/entradas', [EntradaController::class, 'entradas']);
Route::get('/entradas/{b}', [EntradaController::class, 'busqueda']);
Route::get('/entrada/{id}', [EntradaController::class, 'entradaId']);
Route::post('/guardar', [EntradaController::class, 'guardar']);
Route::put('/actualizar/{id}', [EntradaController::class, 'actualizar']);
Route::delete('/eliminar/{id}', [EntradaController::class, 'eliminar']);
