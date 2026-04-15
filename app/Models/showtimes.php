<?php

namespace App\Models;

use Database\Factories\ShowtimesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class showtimes extends Model
{
    /** @use HasFactory<ShowtimesFactory> */
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'hall_id',
        'start_time',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
        ];
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(movies::class, 'movie_id');
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(halls::class, 'hall_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(bookings::class, 'showtime_id');
    }
}
