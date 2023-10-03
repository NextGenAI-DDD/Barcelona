<?php


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

Route::get('/table', [\App\Http\Controllers\LaLiga\laLigaTableController::class, 'index'])->name('table');
Route::get('/player', [\App\Http\Controllers\BarcelonaTeam\PlayerController::class, 'index'])->name('player');


Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
