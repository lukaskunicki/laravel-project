<?php

use App\Http\Controllers\ClubsControler;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\PlayersController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('players')->group(function () {
    Route::get('/', [PlayersController::class, "index"]);
    Route::get('/club/{id}', [PlayersController::class, "fromClub"]);
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/edit/{id}', [PlayersController::class, "edit"]);
        Route::post('/update/{id}', [PlayersController::class, "update"]);
        Route::get('/create', [PlayersController::class, "create"]);
        Route::post('/add', [PlayersController::class, "add"]);
        Route::get('/delete/{id}', [PlayersController::class, "delete"]);
    });
});

Route::prefix('clubs')->group(function () {
    Route::get('/', [ClubsControler::class, "index"]);
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/edit/{id}', [ClubsControler::class, "edit"]);
        Route::get('/create', [ClubsControler::class, "create"]);
        Route::post('/add', [ClubsControler::class, "add"]);
        Route::get('/delete/{id}', [ClubsControler::class, "delete"]);
        Route::post('/update/{id}', [ClubsControler::class, "update"]);
    });
});

Route::prefix('leagues')->group(function () {
    Route::get('/', [LeaguesController::class, "index"]);
    Route::get('/clubs/{id}', [LeaguesController::class, "clubsInLeague"]);
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/edit/{id}', [LeaguesController::class, "edit"]);
        Route::get('/create', [LeaguesController::class, "create"]);
        Route::post('/add', [LeaguesController::class, "add"]);
        Route::get('/remove/{id}', [LeaguesController::class, "delete"]);
        Route::post('/update/{id}', [LeaguesController::class, "update"]);
    });
});
