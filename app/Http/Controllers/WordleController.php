<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class WordleController extends Controller
{
    public function index()
    {
        $guesses = session('guesses', []);
        return view('wordle.index', compact('guesses'));
    }

    public function check(Request $request)
    {
        $guess = $request->input('guess');
        $word = Word::inRandomOrder()->first()->word;

        if (strlen($guess) != strlen($word)) {
            return response()->json(['error' => 'Invalid guess length.'], 400);
        }

        $result = [];
        $correctGuess = true;

        for ($i = 0; $i < strlen($word); $i++) {
            if ($guess[$i] === $word[$i]) {
                $result[] = ['letter' => $guess[$i], 'status' => 'correct'];
            } elseif (strpos($word, $guess[$i]) !== false) {
                $result[] = ['letter' => $guess[$i], 'status' => 'present'];
                $correctGuess = false;
            } else {
                $result[] = ['letter' => $guess[$i], 'status' => 'absent'];
                $correctGuess = false;
            }
        }

        // Haal de huidige gissingen uit de sessie
        $guesses = session('guesses', []);
        // Voeg de nieuwe gok toe
        $guesses[] = ['guess' => $guess, 'result' => $result];
        // Sla de bijgewerkte gissingen op in de sessie
        session(['guesses' => $guesses]);

        return response()->json([
            'result' => $result,
            'correct' => $correctGuess
        ]);
    }
}
