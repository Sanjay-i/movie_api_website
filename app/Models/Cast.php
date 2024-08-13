<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = [ 'profile_path', 'character', 'name',];

    public function credits()
    {
        return $this->morphMany(Credit::class, 'creditable');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_cast');
    }

    public function tvshows()
    {
        return $this->belongsToMany(Movie::class, 'tv_show_cast');
    }
}
