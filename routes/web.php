<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordleController;
use App\Http\Controllers\FriendRequestController;



Route::get('/', [LandingPageController::class, 'index'])->name('landing');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/friend-request', [FriendRequestController::class, 'sendRequest'])->name('friend-request.send');
    Route::post('/friend-request/{id}/accept', [FriendRequestController::class, 'acceptRequest'])->name('friend-request.accept');
    Route::get('/friend-requests', [FriendRequestController::class, 'listRequests'])->name('friend-request.list');
    Route::get('/friends', [FriendRequestController::class, 'listFriends'])->name('friends.list');



    Route::get('/games/random', [GameController::class, 'startRandomGame'])->name('games.random');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('/games/{game}/play', [GameController::class, 'play'])->name('games.play');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/check', [WordleController::class, 'check']);
    Route::get('/game', [WordleController::class, 'index'])->name('wordle.game');
});

require __DIR__ . '/auth.php';
