<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use \Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function startRandomGame()
    {
        $user = Auth::user();
        $opponent = User::where('id', '!=', $user->id)
                        ->whereDoesntHave('gamesAsPlayer1', function($query) use ($user) {
                            $query->where('status', '!=', 'completed')
                                  ->where('player2_id', $user->id);
                        })
                        ->whereDoesntHave('gamesAsPlayer2', function($query) use ($user) {
                            $query->where('status', '!=', 'completed')
                                  ->where('player1_id', $user->id);
                        })
                        ->inRandomOrder()
                        ->first();

        if (!$opponent) {
            return redirect()->back()->with('error', 'No available opponents at the moment.');
        }

        $game = Game::create([
            'player1_id' => $user->id,
            'player2_id' => $opponent->id,
            'status' => 'pending',
        ]);

        return redirect()->route('games.show', $game);
    }

    public function startFriendGame(Request $request)
    {
        $user = Auth::user();
        $friend = User::find($request->friend_id);

        if (!$friend || !$user->friends()->where('friend_id', $friend->id)->exists()) {
            return redirect()->back()->with('error', 'Friend not found or not in your friends list.');
        }

        $game = Game::create([
            'player1_id' => $user->id,
            'player2_id' => $friend->id,
            'status' => 'pending',
        ]);

        return redirect()->route('games.show', $game);
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function play(Request $request, Game $game)
    {
        $user = Auth::user();

        if ($game->status != 'pending' || $user->id != $game->player2_id) {
            return redirect()->back()->with('error', 'Invalid game state.');
        }

        $game->update([
            'word' => $request->word,
            'status' => 'completed',
            'winner_id' => $this->determineWinner($request->word),
        ]);

        return redirect()->route('games.show', $game);
    }

    private function determineWinner($word)
    {
        // Placeholder for game logic to determine the winner based on the word
        // For now, let's assume the second player wins if the word is not empty
        return !empty($word) ? Auth::id() : null;
    }
}
