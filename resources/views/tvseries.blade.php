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
                        <a href="{{ route('get.movies')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 ">Movies</a>
                    </li>
                    <li>
                    <a href="{{ route('get.tvShows')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 ">Tv shows</a>
                    </li>
                    <li>
                    <a href="{{ route('get.actors')}}" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 ">Actors</a>
                    </li>
                    <li>
                    <a href="#" class="block py-2 px-3 text-orange-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"></a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    
    <br>
    <br>
    <br>
    <br>
    <br>
        <div class="container grid grid-cols-0 gap-1 px-2 ps-3 ms-3 justify-center items-center">
            @if (isset($shows) && !empty($shows))
                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 ">
                    @foreach($shows as $show)
                        
                        <figure class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0 ">
                            <a href="{{ route('tv_show.details', ['id' => $show['tmdb_id']]) }}">
                            <img class="rounded-lg" src="{{ $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$show['poster_path'] :asset('images/No.jpg')}}" alt="image description">
                            </a>
                            <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                <h2 class="text-lg font-semibold">{{ $show['name'] }}</h2>
                            </figcaption>
    
                        </figure>
                
                    @endforeach
                </div>
            
            @endif
        </div>
  
    <!-- Pagination Links -->
    <div class="flex justify-center items-center mt-12">
        {{ $shows->links() }}
    </div> 
</body>
</html>