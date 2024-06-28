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
                background-color: greenyellow;
                color: black;
            }

            .friend-section .btn-info {
                width: 200px;
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
        <div class="container">
            <h1>Your Friends</h1>
            <ul>
                @foreach ($friends as $friend)
                    <li>{{ $friend->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="friend-section">
            <h2>Want to add a friend to play with?</h2>
            <p>Add them here!</p>
            <form action="{{ route('friend-request.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Friend's Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>

            </form>
            <a href="{{ route('friend-request.list') }}" class="btn btn-info">View Friend Requests</a>
        </div>
