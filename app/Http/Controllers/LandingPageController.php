<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;

class LandingPageController extends Controller
{
    public function index()
    {
        $leaderboard_daily = User::withCount(['gamesAsPlayer1 as wins' => function ($query) {
            $query->where('winner_id', '!=', null)->whereDate('created_at', now()->toDateString());
        }, 'gamesAsPlayer2 as wins' => function ($query) {
            $query->where('winner_id', '!=', null)->whereDate('created_at', now()->toDateString());
        }])->orderBy('wins', 'desc')->take(10)->get();

        $leaderboard_weekly = User::withCount(['gamesAsPlayer1 as wins' => function ($query) {
            $query->where('winner_id', '!=', null)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        }, 'gamesAsPlayer2 as wins' => function ($query) {
            $query->where('winner_id', '!=', null)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        }])->orderBy('wins', 'desc')->take(10)->get();

        $leaderboard_all_time = User::withCount(['gamesAsPlayer1 as wins' => function ($query) {
            $query->where('winner_id', '!=', null);
        }, 'gamesAsPlayer2 as wins' => function ($query) {
            $query->where('winner_id', '!=', null);
        }])->orderBy('wins', 'desc')->take(10)->get();

        return view('landing', compact('leaderboard_daily', 'leaderboard_weekly', 'leaderboard_all_time'));
    }
}
