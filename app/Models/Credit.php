<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',        
        'creditable_id',    
        'creditable_type'   
    ];
    
    public function creditable()
    {
        return $this->morphTo();
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
