<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }

    public function tvShows()
    {
        return $this->belongsToMany(TvShow::class, 'tv_show_genre','genre_id', 'tv_show_id');
    }
}
