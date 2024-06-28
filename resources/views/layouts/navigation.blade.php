<nav class="navbar">
    <div class="logo">
        <img src="images/sga-logo.png" class="sga-logo">
    </div>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/game">Game</a></li>
        <li><a href="/profile/edit">Profile</a></li>
        <li><a href="/friends">Friends</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            style="background:none;border:none;color:black;font-size:18px;cursor:pointer;">Log Out</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
        @endif
    </ul>
</nav>

<style>
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
