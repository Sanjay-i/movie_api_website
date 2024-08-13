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
                    <a href="{{ route('get.tvShows')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 ">Tv shows</a>
                    </li>
                    <li>
                    <a href="{{ route('get.actors')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 ">Actors</a>
                    </li>
                    <li>
                    <a href="#" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 active:text-pink-500 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"></a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    
    <br>
    <br>
        <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center mx-auto px-4 py-16">
            @if(isset($movies) && count($movies) > 0)
                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                    @foreach($movies as $movie)
                        
                    <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 ">
                        <a href="{{ route('movies.details', ['id' => $movie['tmdb_id']]) }}">
                        <img class="rounded-lg" src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'] : asset('images/NoImage.jpg') }}" alt="{{ $movie->title }}">
                        </a>
                        <figcaption class="absolute px-4 text-lg text-white bottom-6">
                            <h2 class="text-lg font-semibold">{{ $movie['title'] }}</h2>
                        </figcaption>
    
                    </figure>
                
                    @endforeach
                 </div>
            
            @endif
        </div>

  {{--   --}}
        {{-- <div class="flex justify-center items-center mt-6">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Previous</span>
                    <!-- Heroicon name: chevron-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                <span
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">8</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">9</a>
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">10</a>
                <a href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Next</span>
                    <!-- Heroicon name: chevron-right -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>

            </nav>
        </div> --}}
    
        <!-- Pagination Links -->
    <div class="flex justify-center items-center mt-12">
        {{ $movies->links() }}
    </div> 





    
 
</body>
</html>