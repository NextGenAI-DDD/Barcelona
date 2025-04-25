<?php

use App\Http\Controllers\Api\BarcelonaTeam\PlayerController;
use App\Http\Controllers\Api\LaLiga\GameController;
use App\Http\Controllers\Api\LaLiga\LaLigaTabelaController;
use App\Http\Controllers\Api\LaLiga\TopAssistController;
use App\Http\Controllers\Api\LaLiga\TopScoreController;
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

Route::apiResource('top-assist',TopAssistController::class)->except([
    'create', 'show', 'edit'
]);

Route::apiResource('top-score',TopScoreController::class)->except([
    'create', 'show', 'edit'
]);

Route::apiResource('player',PlayerController::class)->except([
    'create', 'show', 'edit'
]);

Route::apiResource('game',GameController::class)->except([
    'create', 'show', 'edit'
]);

