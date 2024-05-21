<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
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
    <main>

        <div class="container">
            <h1>Welkom op het Spelplatform</h1>
            <p>Hier kun je verschillende spellen spelen en je vrienden uitdagen!</p>

            <h2>Leaderboard</h2>
            <!-- Leaderboard logic hier -->
            <ul>
                <li>Dagelijkse winnaars</li>
                <li>Wekelijkse winnaars</li>
                <li>All-time winnaars</li>
            </ul>
        </div>


        <div class="container">
            <h1>Welkom op het Spelplatform</h1>
            <p>Hier kun je verschillende spellen spelen en je vrienden uitdagen!</p>

            <h2>Leaderboard</h2>
            <h3>Dagelijkse Winnaars</h3>
            <ul>
                @foreach ($dailyWinners as $winner)
                    <li>{{ $winner->name }} - {{ $winner->wins }} winst(en)</li>
                @endforeach
            </ul>
            <h3>Wekelijkse Winnaars</h3>
            <ul>
                @foreach ($weeklyWinners as $winner)
                    <li>{{ $winner->name }} - {{ $winner->wins }} winst(en)</li>
                @endforeach
            </ul>
            <h3>All-time Winnaars</h3>
            <ul>
                @foreach ($allTimeWinners as $winner)
                    <li>{{ $winner->name }} - {{ $winner->wins }} winst(en)</li>
                @endforeach
            </ul>
        </div>


    </main>
</body>

</html>
