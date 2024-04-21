<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
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

Route::get('games/get-games', [GameController::class, 'getGames'])->name('games.get-games');
Route::get('games/get-game/{game}', [GameController::class, 'getGame'])->name('games.get-game');

Route::get('users/{user}/get-credits', [UserController::class, 'getCredits'])->name('users.get-credits');
Route::get('users/{user}/get-active-game', [UserController::class, 'getActiveGame'])->name('users.get-active');

Route::post('users/{user}/start-game', [UserController::class, 'startGame'])->name('users.start-game');
Route::post('users/{user}/stop-game', [UserController::class, 'stopGame'])->name('users.stop-game');
