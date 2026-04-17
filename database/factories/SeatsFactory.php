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
            'hall_id' => halls::factory(),
            'row' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']),
            'number' => fake()->numberBetween(1, 10),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (seats $seat) {
            // Ensure seats match hall capacity (max 100 for 10x10)
            $hall = $seat->hall;
            $totalSeatsInHall = $hall->seats()->count();

            if ($totalSeatsInHall > 100) {
                // Delete excess seats
                $hall->seats()->latest()->limit($totalSeatsInHall - 100)->delete();
            }
        });
    }
}
