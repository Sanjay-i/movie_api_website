<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profile_path',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actors');
    }

    public function tvShows()
    {
        return $this->belongsToMany(TvShow::class, 'tv_show_actors');
    }
}
