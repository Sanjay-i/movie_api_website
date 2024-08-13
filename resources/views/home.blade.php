<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    
</head>
<body class="bg-slate-900">

 <div class="header-img">
        
        <form id="searchForm" action="{{ route('movies.search') }}" method="GET" class="mb-6">
            
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
                            <a href="{{ route('get.movies')}}" class="block py-2 px-3 text-orange-500 rounded active:text-pink-500 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Movies</a>
                        </li>
                        <li>
                        <a href="{{ route('get.tvShows')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Tv shows</a>
                        </li>
                        <li>
                        <a href="{{ route('get.actors')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Actors</a>
                        </li>
                        <li>
                        <a href="#" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"></a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
      
            <div class="flex items-center justify-center pt-32 ">
                <div class="flex border-2 border-gray-200 rounded">
                    <input type="text" name="query" class="px-4 py-2 w-80" placeholder="Search..." value="{{ old('query', $query ?? '') }}" required>
                    <button type="submit" class="px-4 text-white bg-gray-600 border-l ">
                        Search
                    </button>
                </div>
            </div>
            <div class="flex items-center mt-4 justify-center py-6">
                <input type="radio" id="movie" name="type" value="movie" class="w-4 h-4 text-yellow-300 bg-yellow-100 border-orange-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"  checked>
                <label for="movie" class="ml-2 text-sm font-medium text-yellow-300 dark:text-yellow-300 ">Movie</label>
                <input type="radio" id="tv-show" name="type" value="tv-show" class="w-4 h-4 text-blue-600 bg-gray-100 border-orange-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 ml-5">
                <label for="tv-show" class="ml-2 text-sm font-medium text-yellow-300 dark:text-yellow-300">TV Show</label>
            </div>
            </div>
            
        </form>

        <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center ">
            @if(isset($movies) && count($movies) > 0)
                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                    @foreach($movies as $movie)
                        
                    <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter ">
                        <a href="{{ route('movies.details', ['id' => $movie['id']]) }}">
                        <img class="rounded-lg" src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'] : asset('images/no.jpg') }}" alt="image description">
                        </a>
                        <figcaption class="absolute px-4 text-lg text-white bottom-6">
                            <h2 class="text-lg font-semibold">{{ $movie['title'] }}</h2>
                        </figcaption>

                    </figure>
                
                    @endforeach
                </div>
            
            @endif
        </div>

        <div class="container grid grid-cols-0 gap-1 px-2 ps-3 ms-3 justify-center items-center">
            @if (isset($shows) && !empty($shows))
                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                    @foreach($shows as $show)
                        
                        <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter ">
                            <a href="{{ route('tv_show.details', ['id' => $show['id']]) }}">
                            <img class="rounded-lg" src="{{ $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$show['poster_path'] :asset('images/no.jpg')}}" alt="image description">
                            </a>
                            <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                <h2 class="text-lg font-semibold">{{ $show['name'] }}</h2>
                            </figcaption>

                        </figure>
                
                    @endforeach
                </div>
            
            @endif
        </div>
    <br>
    <br>
    <br>
    <br>
</div>

        
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container mx-auto px-4 pt-1 ">
        <div class=" pb-2">

            <h2 class="border-b border-yellow-200 text-orange-500 px-16 text-2xl">Trends Now</h2>

            {{-- this Catagorise are necessary for future --}}
            {{-- <br>
            <div class="container flex flex-row  justify-around">
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Action</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Adventure</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Crime</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Comedy</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Thrillers</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Animated</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Sci-fi</a>
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"> Documentaries</a>
            </div> --}}
            <br>
            <br>
            <br>
            <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center">
                @if (isset($popularMovie) && !empty($popularMovie) )
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                        @foreach($popularMovie as $popularMovie)
                            @if ($loop->index < 6)
                            
                                <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                    <a href="{{ route('movies.details', ['id' => $popularMovie['id']]) }}">
                                    <img class="rounded-lg" src="https://image.tmdb.org/t/p/w500{{$popularMovie['poster_path']}}" alt="image description">
                                    </a>
                                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                        <h2 class="text-lg font-semibold">{{ $popularMovie['title'] }}</h2>
                                    </figcaption>
                                </figure>
                            @endif
                        @endforeach
                    </div>     
                @endif 
        </div>
    </div>

    <div class="container mx-auto px-4 pt-1 ">
        <div class=" pb-2">
            <h2 class="border-b border-yellow-200 text-orange-500 px-16 text-2xl">Top Flims</h2>
            <br>
            <br>
            <br>
            <br>
            <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center">
                @if (isset($topRated) && !empty($topRated) )
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                        @foreach($topRated as $top)
                            @if ($loop->index < 6)
                            
                                <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                    <a href="{{ route('movies.details', ['id' => $top['id']]) }}">
                                    <img class="rounded-lg" src="https://image.tmdb.org/t/p/w500{{$top['poster_path']}}" alt="image description">
                                    </a>
                                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                        <h2 class="text-lg font-semibold">{{ $top['title'] }}</h2>
                                    </figcaption>
                                </figure>
                            @endif
                        @endforeach
                    </div>
                @endif
        </div>
    </div>

    <div class="container mx-auto px-4 pt-1 ">
        <div class=" pb-2">

            <h2 class="border-b border-yellow-200 text-orange-500 px-16 text-2xl">Up Comings</h2>
            <br>
            <br>
            <br>
            <br>
            <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center">
                @if (isset($upcomingMovies) && !empty($upcomingMovies) )
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                        @foreach($upcomingMovies as $upcoming)
                            @if ($loop->index < 6)
                            
                                <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                    <a href="{{ route('movies.details', ['id' => $upcoming['id']]) }}">
                                    <img class="rounded-lg" src="https://image.tmdb.org/t/p/w500{{$upcoming['poster_path']}}" alt="image description">
                                    </a>
                                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                        <h2 class="text-lg font-semibold">{{ $upcoming['title'] }}</h2>
                                    </figcaption>

                                </figure>
                            @endif
                        @endforeach
                    </div>
                @endif   
        </div>

    </div>

    <div class="container mx-auto px-4 pt-1 ">
        <div class=" pb-2">

            <h2 class="border-b border-yellow-200 text-orange-500 px-16 text-2xl">Trend Series</h2>
            <br>
           
            <br>
            <br>
            <br>
            <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center">

                @if (isset($seriesList) && !empty($seriesList) )
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                        @foreach($seriesList as $list)
                            @if ($loop->index < 6)
                            
                                <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                    <a href="{{ route('tv_show.details', ['id' => $list['id']]) }}">
                                    <img class="rounded-lg" src="https://image.tmdb.org/t/p/w500{{$list['poster_path']}}" alt="image description">
                                    </a>
                                    <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                        <h2 class="text-lg font-semibold">{{ $list['name'] }}</h2>
                                    </figcaption>

                                </figure>
                            @endif
                        @endforeach
                    </div>
                
                @endif
                
        
        </div>

    </div>

    
  <script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        var movieRoute = "{{ route('movies.search') }}";
        var tvShowRoute = "{{ route('tv_show.search') }}";
        
        if (document.getElementById('tv-show').checked) {
            this.action = tvShowRoute;
        } else {
            this.action = movieRoute;
        }
    });
</script> 
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2" defer></script>


   
</body>
</html>