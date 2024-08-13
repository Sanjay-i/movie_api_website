<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'department', 'job'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_crew');
    }

    public function tvshows()
    {
        return $this->belongsToMany(Movie::class, 'tv_show_crew');
    }
    
    public function credits()
    {
        return $this->morphMany(Credit::class, 'creditable');
    }
}
