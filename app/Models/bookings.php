<?php

namespace App\Models;

use Database\Factories\BookingsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class bookings extends Model
{
    /** @use HasFactory<BookingsFactory> */
    use HasFactory;

    protected $fillable = [
        'users_id',
        'showtime_id',
        'seats_id',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function showtime(): BelongsTo
    {
        return $this->belongsTo(showtimes::class, 'showtime_id');
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(seats::class, 'seats_id');
    }
}
