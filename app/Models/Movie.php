<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'overview',
        'release_date',
        'poster_path',
        'runtime',
        'tmdb_id',
        'imdb_id',
        'vote_average',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function crew()
    {
        return $this->belongsToMany(Crew::class, 'movie_crew','movie_id', 'crew_id');
    }

     public function credits()
    {
        return $this->morphMany(Credit::class, 'creditable');
    }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'movie_cast', 'movie_id', 'cast_id');
    }

}
