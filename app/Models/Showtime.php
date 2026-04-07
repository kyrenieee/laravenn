<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $primaryKey = 'showtime_id';

    protected $fillable = [
        'movie_id',
        'theater_id',
        'start_time',
        'price',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'movie_id');
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'theater_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'showtime_id', 'showtime_id');
    }
}
