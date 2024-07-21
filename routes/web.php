<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/member/details', [MembersController::class, 'memberDetails']);
Route::get('/game/create', [GamesController::class, 'create'])->name('create.game');
Route::get('/view/games', [GamesController::class, 'index'])->name('view.games');
Route::get('/leaderboard/games', [GamesController::class, 'leaderboard'])->name('leaderboard.games');
Route::get('/game/details/{game}', [GamesController::class, 'gameDetails'])->name('details.games');
Route::post('/create/game', [GamesController::class, 'createGame']);
Route::post('/add/player', [GamesController::class, 'addPlayer']);
Route::post('/game/start', [GamesController::class, 'startGame']);
Route::post('/game/end', [GamesController::class, 'endGame']);
Route::post('/member/contact/update', [MembersController::class, 'updateContact']);
Route::post('/game/update/score', [GamesController::class, 'updateScore']);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
