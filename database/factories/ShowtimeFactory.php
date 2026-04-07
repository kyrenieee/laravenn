<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Theater;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowtimeFactory extends Factory
{
    protected $model = Showtime::class;

    public function definition(): array
    {
        return [
            'movie_id'   => Movie::factory(),
            'theater_id' => Theater::factory(),
            'start_time' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d H:i:s'),
            'price'      => $this->faker->randomElement([250.00, 320.00, 350.00, 450.00, 550.00]),
        ];
    }
}
