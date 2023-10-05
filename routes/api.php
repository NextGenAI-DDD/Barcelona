<?php

use App\Http\Controllers\Api\LaLigaTabelaController;
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

Route::apiResource('laLigaTable',LaLigaTabelaController::class)->except([
    'create', 'show', 'edit'
]);

Route::apiResource('top-assist',\App\Http\Controllers\Api\TopAssistController::class)->except([
    'create', 'show', 'edit'
]);
