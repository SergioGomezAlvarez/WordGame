<div class="container">
    <h1>Game</h1>
    <p>Player 1: {{ $game->player1->name }}</p>
    <p>Player 2: {{ $game->player2->name }}</p>

    @if ($game->status == 'pending' && auth()->id() == $game->player2_id)
        <form action="{{ route('games.play', $game) }}" method="POST">
            @csrf
            <input type="text" name="word" placeholder="Enter your word">
            <button type="submit">Play</button>
        </form>
    @endif

    @if ($game->status == 'completed')
        <p>Winner: {{ $game->winner->name }}</p>
    @endif
</div>
