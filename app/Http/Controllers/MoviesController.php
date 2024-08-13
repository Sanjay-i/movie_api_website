<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Jobs\StoreMovieJob;
use Illuminate\Support\Facades\Log;
use App\Models\Movie;
use App\Models\TvShow;
use App\Models\Cast;
use App\Models\Crew;
use App\Models\Combinedview;

class MoviesController extends Controller
{
    public $search ='hello there';

    public function index(){

        try {

                $tvShow=Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/discover/tv?include_adult=false&include_null_first_air_dates=false&language=en-US&page=1&sort_by=popularity.desc')
                    ->json();

                $movies =Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc')
                    ->json();

                $popularMovie =Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/trending/movie/day?language=en-US')
                    ->json()['results'];


            $searchMovies =Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/collection?include_adult=false&language=en-US&page=1')
                ->json();
        

            $topRated = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1')
                        ->json()['results'];
         
            $upcomingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/upcoming?language=en-US&page=1 ')
            ->json()['results']; 


                $seriesList = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/tv/popular?language=en-US&page=1')
                ->json()['results'];

            $movieGenre =Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/genre/movie/list?language=en')
                    ->json()['genres'];

                $genres = collect($movieGenre)->mapWithKeys(function($genre){
                    return [$genre['id']=>$genre['name']];
                });


        } catch (\Exception $e) {
            // If the API request fails, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to fetch data from the API. Please try again later.');
        }

        return view('home',compact('popularMovie','topRated','upcomingMovies','seriesList'));

    }

    public function smovie(Request $request){

        $query = $request->input('query');

        $searchMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'include_adult' => false,
                'language' => 'en-US',
                'page' => 1,
            ])
            ->json();

        $movies = $searchMovies['results'] ?? [];

        return view('home', compact('movies', 'query'));
    }
    public function searchTvShow(Request $request){

        $query = $request->input('query');

        $SearchTvShow=Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/search/tv',[
            'query' => $query,
            'include_adult' => false,
            'language' => 'en-US',
            'page'=>1,
            ])
        ->json();
        

        $shows =$SearchTvShow['results'] ?? [];

        return view('home', compact('shows', 'query')); 

    }

    public function selectMovie($id){

            // Attempt to find the movie in the local database
            $movie = Movie::where('tmdb_id', $id)
            ->with(['genres','crew','cast'])
            ->first();

            if ($movie) {
                // Movie found in local database, use local data
                $movieDetails = [
                    'title' => $movie->title,
                    'overview' => $movie->overview,
                    'release_date' => $movie->release_date,
                    'poster_path' => $movie->poster_path,
                    'vote_average' => $movie->vote_average,
                    'genres' => $movie->genres->toArray(),
                    'credits' => [
                                    'crew' => $movie->crew->map(function($crewMember) {
                                        return [
                                            'name' => $crewMember->name,
                                            'job' => $crewMember->job,
                                            'profile_path' => $crewMember->profile_path,
                                        ];
                                        })->toArray(),
                                    'cast' => $movie->cast->map(function($castMember) {
                                        return [
                                            'name' => $castMember->name,
                                            'character' => $castMember->character,
                                            'profile_path' => $castMember->profile_path,
                                            ];
                                        })->toArray(),
                                    ], 
                ];
        
            } else {
            // If the movie does not exist, fetch data from the TMDB API
            $movieDetails = Http::withToken(config('services.tmdb.token'))
            ->get("https://api.themoviedb.org/3/movie/{$id}", [
                'language' => 'en-US',
                'append_to_response' => 'credits,videos,images',
            ])
            ->json();
            // Dispatch a job to store the movie details in the database
            StoreMovieJob::dispatch($movieDetails, 'movie');
            }
            // Return the view with the movie details
            return view('layouts.main', compact('movieDetails'));
    }
    
    public function selectTvShow($id)
{
    $tvShow = TvShow::where('tmdb_id', $id)
    ->with(['genres','cast','crew'])
    ->first();

    if ($tvShow) {
        $tvShowDetails = [
            'name' => $tvShow->name,
            'overview' => $tvShow->overview,
            'first_air_date' => $tvShow->first_air_date,
            'poster_path' => $tvShow->poster_path,
            'vote_average' => $tvShow->vote_average,
            'genres' => $tvShow->genres->toArray(),
            'credits' => [
                            'crew' => $tvShow->crew->map(function($crewMember) {
                                return [
                                    'name' => $crewMember->name,
                                    'job' => $crewMember->job,
                                    'profile_path' => $crewMember->profile_path,
                                ];
                                })->toArray(),
                            'cast' => $tvShow->cast->map(function($castMember) {
                                return [
                                    'name' => $castMember->name,
                                    'character' => $castMember->character,
                                    'profile_path' => $castMember->profile_path,
                                    ];
                                })->toArray(),
                            ], 
        ];
    }else{

    
        $tvShowDetails = Http::withToken(config('services.tmdb.token'))
            ->get("https://api.themoviedb.org/3/tv/{$id}", [
                'language' => 'en-US',
                'append_to_response' => 'credits,videos,images',
            ])
            ->json();
        //---- Initialize an array to hold seasons with detailed episodes
        $seasonsWithDetailedEpisodes = [];

        //-- Loop through each season to fetch detailed episode information
        foreach ($tvShowDetails['seasons'] as $season) {
            $seasonNumber = $season['season_number'];     
            //--- Fetch season details including list of episodes
            $seasonDetails = Http::withToken(config('services.tmdb.token'))
                ->get("https://api.themoviedb.org/3/tv/{$id}/season/{$seasonNumber}", [
                    'language' => 'en-US',
                ])
                ->json();
            //--- Initialize an array to hold detailed episode information
            $detailedEpisodes = [];
            //--- Loop through each episode to fetch detailed information
            foreach ($seasonDetails['episodes'] as $episode) {
                $episodeNumber = $episode['episode_number'];

                //--- Fetch detailed episode information
                $episodeDetails = Http::withToken(config('services.tmdb.token'))
                    ->get("https://api.themoviedb.org/3/tv/{$id}/season/{$seasonNumber}/episode/{$episodeNumber}", [
                        'language' => 'en-US',
                    ])
                    ->json();

                $detailedEpisodes[] = $episodeDetails;
            }
            //---- Add season details along with detailed episodes
            $seasonsWithDetailedEpisodes[] = [
                'season' => $seasonDetails,
                'episodes' => $detailedEpisodes
            ];
        }
        //-- Add the detailed season and episode information to the main details array
        $tvShowDetails['seasons_with_detailed_episodes'] = $seasonsWithDetailedEpisodes;
        StoreMovieJob::dispatch($tvShowDetails, 'tv_show');
    }
    return view('series', compact('tvShowDetails'));
}

 
    public function view()
    {
        $data = Combinedview::all();
        // dd($data);

        return view('combined',compact('data'));
    }

    public function getMovies()
    {
        $movies = Movie::paginate(30);
        //  dd($movieDetails);

        return view('movies',compact('movies'));
    }

    public function getTvshows()
    {
        $shows = TvShow::paginate(30);
        //  dd($movieDetails);

        return view('tvseries',compact('shows'));
    }

    public function actors()
    {
        // $actors = Cast::all();
        $actors = Cast::paginate(50);

        return view('actors',compact('actors'));
    }

    
}
