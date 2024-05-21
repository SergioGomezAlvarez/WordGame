<div class="container">
    <h1>Vrienden</h1>
    <form method="POST" action="{{ route('friends.store') }}">
        @csrf
        <div class="form-group">
            <label for="friend_name">Zoek op naam of email</label>
            <input type="text" class="form-control" id="friend_name" name="friend_name">
            <input type="text" class="form-control" id="friend_email" name="friend_email">
        </div>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
    <ul>
        @foreach ($friends as $friend)
            <li>{{ $friend->friend->name }} ({{ $friend->status }})</li>
            @if ($friend->status == 'pending' && $friend->friend_id == auth()->id())
                <form method="POST" action="{{ route('friends.update', $friend->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="accepted" class="btn btn-success">Accepteer</button>
                    <button type="submit" name="status" value="rejected" class="btn btn-danger">Weiger</button>
                </form>
            @endif
        @endforeach
    </ul>
</div>
