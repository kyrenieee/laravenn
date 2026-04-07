<?php

namespace Database\Factories;

use App\Models\Theater;
use Illuminate\Database\Eloquent\Factories\Factory;

class TheaterFactory extends Factory
{
    protected $model = Theater::class;

    private static array $names = [
        'Hall A', 'Hall B', 'Hall C', 'IMAX 3D', 'Screen 1',
        'Screen 2', 'VIP Lounge', 'Dolby Atmos Hall', '4DX Theater', 'Classic Hall',
    ];

    private static int $nameIndex = 0;

    public function definition(): array
    {
        $name = self::$names[self::$nameIndex % count(self::$names)];
        self::$nameIndex++;

        return [
            'name'     => $name,
            'capacity' => $this->faker->randomElement([80, 100, 120, 150, 200, 250, 300]),
        ];
    }
}
