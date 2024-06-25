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
            }

            .friend-section .btn-info{
                width: 200px;
            }
        </style>
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
