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
    


        
    <form id="searchForm" action="{{ route('movies.search') }}" method="GET" class="mb-6">
        <div class="flex items-center justify-center py-6">
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
            <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 ">
                @foreach($movies as $movie)
                    
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="https://image.tmdb.org/t/p/w500{{$movie['poster_path']}}" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $movie['title'] }}</h5>
                            </a>
                            <a href="{{ route('movies.details', ['id' => $movie['id']]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Details
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            
                @endforeach
             </div>
        
        @endif
    </div>
{{-- ------------ --}}

{{--  --}}
    <div class="container grid grid-cols-0 gap-1 px-2 ps-3 ms-3 justify-center items-center">
        @if (isset($shows) && !empty($shows))
            <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 ">
                @foreach($shows as $show)
                    
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="https://image.tmdb.org/t/p/w500{{$show['poster_path']}}" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $show['original_name'] }}</h5>
                            </a>
                            <a href="{{ route('tv_show.details', ['id' => $show['id']]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Details
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            
                @endforeach
            </div>
        
        @endif
    </div>

    <div class="container mx-auto px-4 pt-1">
        <div class=" pb-24">

            <h2 class="text-orange-500 px-16 text-2xl">Popular ---Movies</h2>
            <div class="container grid grid-cols gap-1 px-2 ps-3 ms-3 justify-center items-center">
                @if (isset($popularMovie) && !empty($popularMovie))
                    <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 ">
                        @foreach($popularMovie as $popularMovie)
                            
                            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <img class="rounded-t-lg" src="https://image.tmdb.org/t/p/w500{{$popularMovie['poster_path']}}" alt="" />
                                </a>
                                <div class="p-5">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $popularMovie['original_title'] }}</h5>
                                    </a>
                                    <a href="{{ route('movies.details', ['id' => $popularMovie['id']]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Details
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                    
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


   
</body>
</html>