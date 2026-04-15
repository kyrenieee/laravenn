<?php

namespace Database\Factories;

use App\Models\halls;
use App\Models\seats;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<seats>
 */
class SeatsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hall_id' => halls::factory(), // Automatically creates a Hall for each seat
            'row' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']), // Typical cinema rows
            'number' => fake()->numberBetween(1, 20),
        ];
    }
}
