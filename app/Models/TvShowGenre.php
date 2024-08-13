<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShowGenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'tv_show_id',
        'genre_id',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
