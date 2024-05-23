<div class="container">
    <h1>Nieuw Spel Starten</h1>
    <form method="POST" action="{{ route('games.store') }}">
        @csrf
        <div class="form-group">
            <label for="word">Woord</label>
            <input type="text" class="form-control" id="word" name="word" required>
        </div>
        <div class="form-group">
            <label for="opponent_type">Tegenstander Type</label>
            <select class="form-control" id="opponent_type" name="opponent_type" required>
                <option value="random">Willekeurig</option>
                <option value="friend">Vriend</option>
            </select>
        </div>
        <div class="form-group" id="friend_select" style="display: none;">
            <label for="friend_id">Kies Vriend</label>
            <select class="form-control" id="friend_id" name="friend_id">
                @foreach ($friends as $friend)
                    <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                @endforeach
            </select>
        </div>
        <div></div>
        <button type="submit" class="btn btn-primary">Start Spel Test</button>
    </form>
</div>
<script>
    document.getElementById('opponent_type').addEventListener('change', function() {
        if (this.value === 'friend') {
            document.getElementById('friend_select').style.display = 'block';
        } else {
            document.getElementById('friend_select').style.display = 'none';
        }
    });
</script>
