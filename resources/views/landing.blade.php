<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .leaderboard-section {
            margin-bottom: 40px;
        }

        .leaderboard-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .leaderboard-list {
            list-style-type: none;
            padding-left: 0;
        }

        .leaderboard-list li {
            font-size: 1.2rem;
            padding: 10px;
            border-bottom: 2px solid #dee2e6;
        }

        .container-play-game {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 200px;
        }

        .play-game-text-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 80%;
            height: 80px;
        }

        .play-game-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 15%;
            height: 40px;
            text-decoration: none;
            border-radius: 10px;
            border: 1px solid black;
            background-color: greenyellow;
            color: black;
            cursor: pointer;
        }

        .play-game-button:hover {
            text-decoration: none;
            background-color: rgb(111, 179, 9);
            color: black;
        }

        .friend-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .friend-section h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .friend-section .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .friend-section .form-group input {
            width: 300px;
            margin-bottom: 10px;
        }

        .friend-section .btn {
            width: 100px;
            margin: 5px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            border-bottom: 3px solid greenyellow;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .logo img {
            height: 50px;
            vertical-align: middle;
        }

        .navbar .nav-links {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar .nav-links li {
            margin-left: 20px;
        }

        .navbar .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 18px;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="images/sga-logo.png" class="sga-logo" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/game">Game</a></li>
            <li><a href="/profile/edit">Profile</a></li>
            <li><a href="/friends">Friends</a></li>
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            @endif
        </ul>
    </nav>

    <div class="container">
        <div class="text-center">
            <h1 class="display-4">Welcome to the Game</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="leaderboard-section">
                    <h2 class="leaderboard-title">Daily</h2>
                    <ul class="leaderboard-list">
                        @foreach ($leaderboard_daily as $user)
                            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
                        @endforeach
                    </ul>
                </div>

                <div class="leaderboard-section">
                    <h2 class="leaderboard-title">Weekly</h2>
                    <ul class="leaderboard-list">
                        @foreach ($leaderboard_weekly as $user)
                            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
                        @endforeach
                    </ul>
                </div>

                <div class="leaderboard-section">
                    <h2 class="leaderboard-title">All Time</h2>
                    <ul class="leaderboard-list">
                        @foreach ($leaderboard_all_time as $user)
                            <li>{{ $user->name }} - {{ $user->wins }} wins</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-play-game">
        <div class="play-game-text-container">
            <h1 class="play-game-text">Do you want to play now?!</h1>
        </div>
        <div class="play-game-text-container">
            <a class="play-game-button" href="{{ route('wordle.game') }}">Jump In!</a>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
