<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordleController;


Route::get('/', [LandingPageController::class, 'index'])->name('landing');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/friends', [FriendController::class, 'addFriend'])->name('friends.add');
    Route::post('/friends/{friend}/accept', [FriendController::class, 'acceptFriend'])->name('friends.accept');
    Route::post('/friends/{friend}/decline', [FriendController::class, 'declineFriend'])->name('friends.decline');

    Route::get('/games/random', [GameController::class, 'startRandomGame'])->name('games.random');
    Route::post('/games/friend', [GameController::class, 'startFriendGame'])->name('games.friend');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('/games/{game}/play', [GameController::class, 'play'])->name('games.play');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/check', [WordleController::class, 'check']);
    Route::get('/game', [WordleController::class, 'index'])->name('wordle.game');
});

require __DIR__ . '/auth.php';
