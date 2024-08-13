<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShowActor extends Model
{
    use HasFactory;


    protected $fillable = [
        'tv_show_id',
        'actor_id',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }
}
