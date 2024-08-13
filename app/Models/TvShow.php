<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'overview',
        'release_date',
        'poster_path',
        'number_of_seasons',
        'number_of_episodes',
        'vote_average',
        'first_air_date',
        'tmdb_id'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'tv_show_genre','tv_show_id', 'genre_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'tv_show_actor');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'tv_show_cast', 'tv_show_id', 'cast_id');
    }

    public function crew()
    {
        return $this->belongsToMany(Crew::class, 'tv_show_crew','tv_show_id', 'crew_id');
    }
}
