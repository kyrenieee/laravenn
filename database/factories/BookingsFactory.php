<?php

namespace Database\Factories;

use App\Models\bookings;
use App\Models\seats;
use App\Models\showtimes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<bookings>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => User::factory(),
            'showtime_id' => showtimes::factory(),
            'seats_id' => seats::factory(),

            // Random price between 100 and 500 (adjust to your currency)
            'price' => $this->faker->numberBetween(200, 550),
        ];
    }
}
