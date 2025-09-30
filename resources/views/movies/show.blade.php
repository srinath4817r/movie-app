<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - Rotten Tomatoes Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }
        .poster img {
            width: 300px;
            border-radius: 10px;
        }
        .details {
            flex: 1;
        }
        .details h1 {
            color: #ffcc00;
            margin-top: 0;
        }
        .details p {
            line-height: 1.6;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <a href="{{ route('home') }}" class="back-link">&larr; Back to Home</a>

    <div class="container">
        <div class="poster">
            <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="Poster of {{ $movie->title }}">
        </div>
        <div class="details">
            <h1>{{ $movie->title }}</h1>
            <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}</p>
            <h2>Synopsis</h2>
            <p>{{ $movie->synopsis }}</p>
        </div>
    </div>

</body>
</html>
