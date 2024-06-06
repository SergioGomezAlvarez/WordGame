<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

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
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<header>

    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<body>

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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
