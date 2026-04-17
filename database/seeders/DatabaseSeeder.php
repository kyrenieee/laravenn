<?php

namespace Database\Seeders;

use App\Models\bookings;
use App\Models\halls;
use App\Models\movies;
use App\Models\seats;
use App\Models\showtimes;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Users (1 admin + 9 customers = 10 total)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@cinemaworld.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        // 2. Movies
        movies::factory(10)->create();

        // 3. Halls
        halls::factory(10)->create();

        // 4. Seats (create seats for each hall)
        $hallsData = halls::all();
        foreach ($hallsData as $hall) {
            if ($hall->total_seats > 0) {
                $rows = range('A', 'J'); // 10 rows
                $seatsPerRow = 10; // 10 seats per row, for a max of 100 seats

                $seatCounter = 0;
                foreach ($rows as $row) {
                    for ($number = 1; $number <= $seatsPerRow; $number++) {
                        if ($seatCounter >= $hall->total_seats) {
                            break 2;
                        }
                        seats::create([
                            'hall_id' => $hall->id,
                            'row' => $row,
                            'number' => $number,
                        ]);
                        $seatCounter++;
                    }
                }
            }
        }

        // 5. Showtimes
        showtimes::factory(10)->create();

        // 6. Bookings
        bookings::factory(10)->create();
    }
}
