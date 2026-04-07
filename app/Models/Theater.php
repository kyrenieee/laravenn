<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $primaryKey = 'theater_id';

    protected $fillable = [
        'name',
        'capacity',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class, 'theater_id', 'theater_id');
    }
}
