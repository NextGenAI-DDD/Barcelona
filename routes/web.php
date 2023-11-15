<?php


use App\Http\Controllers\BarcelonaTeam\PlayerController;
use App\Http\Controllers\LaLiga\LaLigaTableController;
use App\Http\Controllers\LaLiga\TopAssistController;
use App\Http\Controllers\LaLiga\TopScoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route without Auth
Route::get('/', function () {
    return view('welcome');
});

// la liga routes
Route::group(['prefix' => 'laLiga'], function () {
    Route::get('/table', [laLigaTableController::class, 'index'])->name('laLiga.table');
    Route::get('/topAssistants', [TopAssistController::class, 'index'])->name('laLiga.topAssistants');
    Route::get('/topScores', [TopScoreController::class, 'index'])->name('laLiga.topScores');
});


Route::get('/player', [PlayerController::class, 'index'])->name('player');


Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
