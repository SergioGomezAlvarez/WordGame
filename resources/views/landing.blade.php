<div class="container">
    <h1>Welcome to the Game</h1>
    <h2>Leaderboard</h2>
    <h3>Daily</h3>
    <ul>
        @foreach ($leaderboard_daily as $user)
            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
        @endforeach
    </ul>
    <h3>Weekly</h3>
    <ul>
        @foreach ($leaderboard_weekly as $user)
            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
        @endforeach
    </ul>
    <h3>All Time</h3>
    <ul>
        @foreach ($leaderboard_all_time as $user)
            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
        @endforeach
    </ul>
</div>
