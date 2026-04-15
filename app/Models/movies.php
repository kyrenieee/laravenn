<?php

namespace App\Models;

use Database\Factories\MoviesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class movies extends Model
{
    /** @use HasFactory<MoviesFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'duration',
        'director',
        'release_date',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'duration' => 'integer',
        ];
    }

    public function showtimes(): HasMany
    {
        return $this->hasMany(showtimes::class, 'movie_id');
    }
}
