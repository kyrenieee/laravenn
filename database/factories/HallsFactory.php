<?php

namespace Database\Factories;

use App\Models\halls;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<halls>
 */
class HallsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static int $index = 0;

    private static array $halls = [
        ['hall_number' => 'Hall A', 'total_seats' => 100],
        ['hall_number' => 'Hall B', 'total_seats' => 100],
        ['hall_number' => 'Hall C', 'total_seats' => 100],
    ];

    public function definition(): array
    {
        $hall = self::$halls[self::$index % count(self::$halls)];
        self::$index++;

        return [
            'hall_number' => $hall['hall_number'],
            'total_seats' => $hall['total_seats'],
            // created_at and updated_at are handled automatically by Laravel
        ];
    }
}
