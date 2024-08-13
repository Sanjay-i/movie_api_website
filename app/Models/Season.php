<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'tv_show_id',
        'season_number',
        'episode_count',
        'poster_path',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
