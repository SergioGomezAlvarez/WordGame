<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @section('content')

        <style>
            .friend-requests-container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .friend-requests-title {
                font-size: 2rem;
                margin-bottom: 20px;
                text-align: center;
                color: #333;
            }

            .friend-request-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                border-bottom: 1px solid #ddd;
            }

            .friend-request-item:last-child {
                border-bottom: none;
            }

            .friend-request-name {
                font-size: 1.2rem;
                color: #555;
            }

            .accept-button {
                padding: 5px 10px;
                font-size: 1rem;
                border-radius: 5px;
                border: none;
                background-color: #28a745;
                color: white;
                cursor: pointer;
            }

            .accept-button:hover {
                background-color: #218838;
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
                                    style="background:none;border:none;color:black;font-size:18px;cursor:pointer;">Log
                                    Out</button>
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
        <div class="container friend-requests-container">
            <h1 class="friend-requests-title">Friend Requests</h1>
            <ul class="list-unstyled">
                @foreach ($requests as $request)
                    <li class="friend-request-item">
                        <span class="friend-request-name">{{ $request->sender->name }}</span>
                        <form action="{{ route('friend-request.accept', $request->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="accept-button">Accept</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
