<div class="container">
    <h1>Spel Details</h1>
    <p>Woord: {{ $game->word }}</p>
    <p>Status: {{ $game->status }}</p>
    <p>Speler 1: {{ $game->playerOne->name }}</p>
    <p>Speler 2: {{ $game->playerTwo->name }}</p>

    @if ($game->status == 'pending' && $game->player_two_id == auth()->id())
        <form method="POST" action="{{ route('games.update', $game->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="active">
            <button type="submit" class="btn btn-success">Accepteer Spel</button>
        </form>
    @endif

    <h2>Reacties</h2>
    <ul>
        @foreach ($game->comments as $comment)
            <li>{{ $comment->content }} - {{ $comment->user->name }}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <div class="form-group">
            <label for="content">Reactie</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Plaats Reactie</button>
    </form>
</div>
