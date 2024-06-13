<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordle Game</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .wordle {
            text-align: center;
        }

        .result {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .result span {
            padding: 10px;
            margin: 2px;
            border: 1px solid #ccc;
        }

        .correct {
            background-color: #6aaa64;
            color: white;
        }

        .present {
            background-color: #c9b458;
            color: white;
        }

        .absent {
            background-color: #787c7e;
            color: white;
        }

        .guesses {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .guess {
            margin-bottom: 10px;
            display: flex;
        }

        .guess span {
            padding: 10px;
            margin: 2px;
            border: 1px solid #ccc;
        }

        .wordgame-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: auto;
            gap: 40px;
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
    </style>
</head>
<body>
    <div class="wordgame-container">
        <a class="play-game-button" href="{{ route('landing') }}">Home</a>

        <div class="wordle">
            <h1>Wordle Game</h1>
            <form id="wordle-form">
                <input type="text" name="guess" id="guess" maxlength="30">
                <button type="submit">Check</button>
            </form>
            <div class="result" id="result"></div>
            <h1>Je recente gissingen:</h1>
            <div class="guesses" id="guesses">
                @foreach ($guesses as $guess)
                    <div class="guess">
                        @foreach ($guess['result'] as $letter)
                            <span class="{{ $letter['status'] }}">{{ $letter['letter'] }}</span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            document.getElementById('wordle-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const guess = document.getElementById('guess').value;

                fetch('/check', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            guess: guess
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const resultDiv = document.getElementById('result');
                        resultDiv.innerHTML = '';
                        if (data.error) {
                            resultDiv.innerHTML = `<span>${data.error}</span>`;
                        } else {
                            data.result.forEach(item => {
                                const span = document.createElement('span');
                                span.textContent = item.letter;
                                span.className = item.status;
                                resultDiv.appendChild(span);
                            });

                            const guessesDiv = document.getElementById('guesses');
                            const guessDiv = document.createElement('div');
                            guessDiv.className = 'guess';
                            data.result.forEach(item => {
                                const span = document.createElement('span');
                                span.textContent = item.letter;
                                span.className = item.status;
                                guessDiv.appendChild(span);
                            });
                            guessesDiv.insertBefore(guessDiv, guessesDiv.firstChild);

                            if (data.correct) {
                                const congratsDiv = document.createElement('div');
                                congratsDiv.innerHTML = `<h2>Congratulations! You've guessed the word!</h2>`;
                                document.querySelector('.wordle').appendChild(congratsDiv);
                            }
                        }
                    });
            });
        </script>
    </div>

</body>
</html>