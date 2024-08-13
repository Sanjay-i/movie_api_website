{{-- @extends('layouts.main')


@section('content')

    
    
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-gray-900 test-white">

    <nav class="bg-slate-700 dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-slate-700 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('movies.data') }}" class="flex items-center text-orange-500 space-x-3 rtl:space-x-reverse">
                <img src="/images/logo.jpg" class="h-8 rounded-xl" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Movies&TvShows</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('get.movies')}}" class="block py-2 px-3 text-orange-500 rounded  hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Movies</a>
                </li>
                <li>
                <a href="{{ route('get.tvShows')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Tv shows</a>
                </li>
                <li>
                <a href="{{ route('get.actors')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Actors</a>
                </li>
                <li>
                <a href="#" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"></a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="movie-ivto border-b border-gray-800 pt-8">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
    
            <img src="{{ $tvShowDetails['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$tvShowDetails['poster_path'] :asset('images/no.jpg')}}" alt="Movie Poster" class="w-62 md:w-72" >
    
            <div class="md:ml-24">
                <h2 class="text-pink-600 text-4xl font-semibold">{{ $tvShowDetails['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <span class="ml-1">{{ $tvShowDetails['vote_average'] * 10 .'%' }}</span>
                <span class="mx-2">|</span>
                <span>{{ $tvShowDetails['first_air_date'] }}</span>
                <span class="mx-2">|</span>
                <span>
                    @foreach ($tvShowDetails['genres'] as $genre) 
                         {{ $genre['name'] }}, @if ($loop->last), @endif
                    @endforeach
                </span>
                </div>
    
                <p class="text-gray-300 mt-8">
                    {{ $tvShowDetails['overview'] }}    
                </p>
    
                <div class="mt-12">
                    <h4 class="text-cyan-300 text-lg font semibold">Featured Cast</h4> 
                    <div class="flex mt-4">
                        @foreach ($tvShowDetails['credits'] ['crew'] as $crew)
                            @if($loop->index <2)
                                <div class="mr-8">
                                    <div class="text-fuchsia-500">{{$crew['name']}}</div>
                                    <div class="text-sm text-yellow-700">{{ $crew['job']}}</div>
                                </div>
                            @endif   
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('movies.data') }}" class="text-blue-500 text-lg hover:underline mt-4 block">Back to Search</a> 
                {{-- There will be a future development of this logic need for play trailer --}}
                
                {{-- <div>
                    @if (count($tvShowDetails['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                id="playTrailerButton"
                                data-trailer-url="https://www.youtube.com/watch?v={{ $tvShowDetails['videos']['results'][0]['key'] }}"
                                class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                                onclick="playTrailer()"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                    <path d="M10.804 8 5 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    @endif
                
                    <a href="{{ route('movies.data') }}" class="text-blue-500 text-lg hover:underline mt-4 block">Back to Search</a>
                
                    <div id="trailerModal" style="background-color: rgba(0, 0, 0, .5);" class="hidden fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button class="text-3xl leading-none hover:text-gray-300" onclick="closeModal()">✖</button>
                                </div>
                
                                <div class="modal-body px-8 py-8">
                                    <div class="aspect-w-1 aspect-h-1">
                                        <iframe width="950" height="400" class="ps-32" id="trailerIframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            
            
        </div>
    </div>
    
    <div class="border-b border-gray-800">
    
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-white text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($tvShowDetails['credits']['cast'] as $cast)
                    @if ($loop->index < 5)

                        <div class="mt-8">
                            <a href="#">
                                <img src="{{ $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path'] :asset('images/no.jpg')}}" alt="actor" class="w-52 md:w-45 hover:opcity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-lg mt-2 hover:text-gray:300">{{$cast['name']}}</a>
                                <div class="text-sm text-fuchsia-400">
                                    {{$cast['character']}}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                @endforeach

            </div>
        </div>
    </div>















    <script>
        function playTrailer() {
            var modal = document.getElementById('trailerModal');
            var iframe = document.getElementById('trailerIframe');
            var trailerButton = document.getElementById('playTrailerButton');
            var trailerUrl = trailerButton.getAttribute('data-trailer-url');
            var embedUrl = trailerUrl.replace('watch?v=', 'embed/');
    
            iframe.src = embedUrl;
            modal.classList.remove('hidden');
        }
    
        function closeModal() {
            var modal = document.getElementById('trailerModal');
            var iframe = document.getElementById('trailerIframe');
    
            iframe.src = '';
            modal.classList.add('hidden');
        }
    </script>    
 
</body>
</html>