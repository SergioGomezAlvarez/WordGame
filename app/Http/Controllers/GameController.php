<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::where('status', 'active')->orWhere('status', 'pending')->get();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        $friends = auth()->user()->friends()->where('status', 'accepted')->get();
        return view('games.create', compact('friends'));
    }

    public function store(Request $request)
    {
        if ($request->opponent_type == 'random') {
            $opponent = User::where('id', '!=', auth()->id())
                            ->whereDoesntHave('games', function ($query) {
                                $query->where('status', 'pending');
                            })->inRandomOrder()->first();
        } else {
            $opponent = User::find($request->friend_id);
        }

        $game = Game::create([
            'player_one_id' => auth()->id(),
            'player_two_id' => $opponent->id,
            'word' => $request->word,
            'status' => 'pending'
        ]);

        return redirect()->route('games.index');
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $game->update($request->all());
        return redirect()->route('games.index');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index');
    }
}
