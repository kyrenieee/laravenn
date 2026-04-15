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

        User::factory(9)->create();

        // 2. Movies
        movies::factory(50)->create();

        // 3. Halls
        halls::factory(3)->create();

        // 4. Seats (create seats for each hall)
        $halls = halls::all();
        foreach ($halls as $hall) {
            seats::factory($hall->total_seats)->create(['hall_id' => $hall->id]);
        }

        // 5. Showtimes
        showtimes::factory(10)->create();

        // 6. Bookings
        bookings::factory(10)->create();
    }
}
