<?php

namespace App\Models;

use Database\Factories\HallsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class halls extends Model
{
    /** @use HasFactory<HallsFactory> */
    use HasFactory;

    protected $fillable = [
        'hall_number',
        'total_seats',
    ];

    protected function casts(): array
    {
        return [
            'total_seats' => 'integer',
        ];
    }

    public function seats(): HasMany
    {
        return $this->hasMany(seats::class, 'hall_id');
    }

    public function showtimes(): HasMany
    {
        return $this->hasMany(showtimes::class, 'hall_id');
    }
}
