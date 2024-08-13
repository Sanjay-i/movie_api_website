<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Movie;
use App\Models\Crew;
use App\Models\Genre;
use App\Models\Cast;
use App\Models\Credit;
use App\Models\Actor;
use App\Models\TvShow;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\Log;

class StoreMovieJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $type;


    public function __construct($details,$type)
    {
       // dd($this->movieDetails);
       $this->details = $details;
       $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->type === 'movie') {
            $this->storeMovie($this->details);
        } elseif ($this->type === 'tv_show') {
            $this->storeTVShowWithEpisodes($this->details);
        }

    }

    protected function storeMovie(array $details)
    {
        $imdbId = $details['imdb_id'] ?? null;
    
        if ($imdbId) {
            $existingMovie = Movie::where('imdb_id', $imdbId)->first();
    
            if (!$existingMovie) {
                // Store genres and prepare an array of genre IDs
                $genreIds = [];
                if (isset($details['genres'])) {
                    foreach ($details['genres'] as $genreData) {
                        $genre = Genre::firstOrCreate(['name' => $genreData['name']]);
                        $genreIds[] = $genre->id;
                        Log::info('Genre stored', ['name' => $genre->name]);
                    }
                }
    
                // Store movie data
                $movie = Movie::create([
                    'title' => $details['title'],
                    'overview' => $details['overview'] ?? null,
                    'release_date' => $details['release_date'] ?? null,
                    'poster_path' => $details['poster_path'] ?? null,
                    'runtime' => $details['runtime'] ?? null,
                    'tmdb_id' => $details['id'] ?? null,
                    'imdb_id' => $imdbId,
                    'vote_average' => $details['vote_average'],
                ]);
    
                Log::info('Movie stored', ['imdb_id' => $movie->imdb_id, 'title' => $movie->title]);
                
                // Associate genres with the movie
                $movie->genres()->sync($genreIds);
    
                // Store and associate cast data
                if (isset($details['credits']['cast'])) {
                    $castIds = [];
                    foreach ($details['credits']['cast'] as $castData) {
                        $cast = Cast::firstOrCreate([
                            'name' => $castData['name'],
                        ], [
                            'character' => $castData['character'] ?? '',
                            'profile_path' => $castData['profile_path'] ?? '',
                        ]);
    
                        $castIds[] = $cast->id;
    
                        Log::info('Cast stored', ['name' => $cast->name, 'character' => $cast->character]);
                    }
                    // Associate cast with the movie
                    $movie->cast()->sync($castIds);
                }
    
                // Store and associate crew data
                if (isset($details['credits']['crew'])) {
                    $crewIds = [];
                    foreach ($details['credits']['crew'] as $crewData) {
                        $crew = Crew::firstOrCreate([
                            'name' => $crewData['name'],
                        ], [
                            'job' => $crewData['job'] ?? '',
                            'department' => $crewData['department'] ?? '',
                        ]);
    
                        $crewIds[] = $crew->id;
    
                        Log::info('Crew stored', ['name' => $crew->name, 'department' => $crew->department, 'job' => $crew->job]);
                    }
                    // Associate crew with the movie
                    $movie->crew()->sync($crewIds);
                }
            }
        }
    }
    


    protected function storeTVShowWithEpisodes(array $details)
    {
        Log::info('Storing TV show details.', ['details' => $details]);

        // Store genres first
        $genreIds = [];
        if (isset($details['genres'])) {
            foreach ($details['genres'] as $genreData) {
                $genre = Genre::updateOrCreate(
                    ['name' => $genreData['name']],
                );
                $genreIds[] = $genre->id;
                Log::info('Genre stored/updated.', ['genre_id' => $genre->id, 'name' => $genreData['name']]);
            }
        }

        // Use a unique key or combination of keys to identify the TV show

        
        $uniqueKey = [
            'tmdb_id' => $details['id'], 
        ];

        //----- Store TV show details----//
        $tvShow = TVShow::updateOrCreate(
            $uniqueKey,
            [
                'name' => $details['name'],
                'overview' => $details['overview'],
                'poster_path' => $details['poster_path'] ?? null,
                'number_of_seasons' => $details['number_of_seasons'],
                'number_of_episodes' => $details['number_of_episodes'],
                'vote_average' => $details['vote_average'],
                'first_air_date' => $details['first_air_date'],
                'tmdb_id' => $details['id'] ?? null,
                
                
            ]
        );

        Log::info('TV show stored/updated.', ['tv_show_id' => $tvShow->id]);

        // Attach genres to the TV show (updates tv_show_genres table)
        if (!empty($genreIds)) {
            $tvShow->genres()->sync($genreIds);
        }

        // Store cast details
        if (isset($details['credits']['cast'])) {
            $castIds = [];
            foreach ($details['credits']['cast'] as $castData) {
                $cast = Cast::updateOrCreate([
                        'name' => $castData['name'],
                    ],
                    [
                        'character' => $castData['character'] ?? '',
                        'profile_path' => $castData['profile_path'] ?? '',
                    ]
                );
                $castIds[] = $cast->id;

                Log::info('Cast stored', ['name' => $cast->name, 'character' => $cast->character]);
            }
            $tvShow->cast()->sync($castIds);
        }

        // Store crew details
        if (isset($details['credits']['crew'])) {
            $crewIds = [];
            foreach ($details['credits']['crew'] as $crewData) {
                $crew = Crew::updateOrCreate([
                        'name' => $crewData['name'],
                    ],
                    [
                        'job' => $crewData['job'] ?? '',
                        'department' => $crewData['department'] ?? '',
                    ]
                );
                $crewIds[] = $crew->id;

                 Log::info('Crew stored', ['name' => $crew->name, 'department' => $crew->department, 'job' => $crew->job]);
            }
            $tvShow->crew()->sync($crewIds);
        }

        //---- Store seasons and episodes ----//
        if (isset($details['seasons_with_detailed_episodes'])) {
            foreach ($details['seasons_with_detailed_episodes'] as $seasonData) {
                $seasonDetails = $seasonData['season'];
                $episodes = $seasonData['episodes'];

                Log::info('Storing season details.', ['season_details' => $seasonDetails]);

                //--- Store season details ---//
                $season = Season::updateOrCreate(
                    [
                        'tv_show_id' => $tvShow->id,
                        'season_number' => $seasonDetails['season_number']
                    ],
                    [
                        'episode_count' => count($episodes),
                        'poster_path' => $seasonDetails['poster_path'] ?? null,
                    ]
                );
                Log::info('Season stored/updated.', ['season_id' => $season->id]);
                //--- Store each episode in the season ---//
                foreach ($episodes as $episodeData) {
                    Log::info('Storing episode details.', ['episode_details' => $episodeData]);

                    Episode::updateOrCreate(
                        [
                            'season_id' => $tvShow->id,
                            'episode_number' => $episodeData['episode_number']
                        ],
                        [
                            'title' => $episodeData['name'],
                            'overview' => $episodeData['overview'] ?? null,
                        ]
                    );
                    Log::info('Episode stored/updated.', ['episode_number' => $episodeData['episode_number']]);
                }
            }
        }
    }

}
       