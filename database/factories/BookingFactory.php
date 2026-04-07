<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Showtime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $row    = $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
        $number = $this->faker->numberBetween(1, 20);

        return [
            'user_id'      => User::factory(),
            'showtime_id'  => Showtime::factory(),
            'seat_number'  => $row . $number,
            'booking_date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s'),
            'status'       => $this->faker->randomElement(['confirmed', 'confirmed', 'confirmed', 'cancelled']),
        ];
    }
}
