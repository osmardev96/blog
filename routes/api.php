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

Route::get('/entradas', [EntradaController::class, 'index']);
Route::get('/entrada/{id}', [EntradaController::class, 'show']);
Route::post('/entrada', [EntradaController::class, 'store']);
Route::put('/entrada/{id}', [EntradaController::class, 'update']);
Route::delete('/entrada/{id}', [EntradaController::class, 'destroy']);
