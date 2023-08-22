<?php


use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/table', [App\Http\Controllers\League\tableController::class, 'index'])->name('table');
Route::get('/players', [App\Http\Controllers\PlayersController::class, 'index'])->name('players');


Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
