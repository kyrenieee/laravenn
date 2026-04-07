<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $primaryKey = 'movie_id';

    protected $fillable = [
        'title',
        'description',
        'genre',
        'duration_minutes',
        'poster_url',
        'release_date',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'movie_id', 'movie_id');
    }
}
