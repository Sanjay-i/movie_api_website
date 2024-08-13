<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{ $movieDetails['title'] }}</title> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-md mx-auto mt-10">
        <div id="movie-details" class="mt-6">
            <h2 class="text-xl font-bold">{{ $movieDetails['title'] }}</h2>
            <p class="mt-4">{{ $movieDetails['overview'] }}</p>
            <img src="https://image.tmdb.org/t/p/w500{{ $movieDetails['poster_path'] }}" alt="Movie Poster" class="mt-4" />
        </div>
        <a href="{{ route('movies.search') }}" class="text-blue-500 hover:underline mt-4 block">Back to Search</a>
    </div>

</body>
</html>
