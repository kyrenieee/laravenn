<?php

namespace App\Models;

use Database\Factories\SeatsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class seats extends Model
{
    /** @use HasFactory<SeatsFactory> */
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'row',
        'number',
    ];

    protected function casts(): array
    {
        return [
            'number' => 'integer',
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(halls::class, 'hall_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(bookings::class, 'seats_id');
    }
}
