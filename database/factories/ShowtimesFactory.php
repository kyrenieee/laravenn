<?php

namespace Database\Factories;

use App\Models\halls;
use App\Models\movies;
use App\Models\showtimes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<showtimes>
 */
class ShowtimesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Connects to a random Movie and CinemaHall
            'movie_id' => movies::factory(),
            'hall_id' => halls::factory(),

            // Generates a random time within the next 4 weeks, rounded to the nearest 30 mins
            'start_time' => $this->faker->dateTimeBetween('now', '+4 days')->format('Y-m-d H:i:00'),
        ];
    }
}
