<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Theater;
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
            'name'     => 'Admin',
            'email'    => 'admin@cinemaworld.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);

        User::factory(9)->create(['role' => 'customer']);

        // 2. Movies – 10 records
        Movie::factory(10)->create();

        // 3. Theaters – 10 records
        Theater::factory(10)->create();

        // 4. Showtimes – 10 records, reuse existing movies & theaters
        $movieIds   = Movie::pluck('movie_id');
        $theaterIds = Theater::pluck('theater_id');

        Showtime::factory(10)->create([
            'movie_id'   => fn() => $movieIds->random(),
            'theater_id' => fn() => $theaterIds->random(),
        ]);

        // 5. Bookings – 10 records, reuse existing users & showtimes
        $userIds     = User::where('role', 'customer')->pluck('id');
        $showtimeIds = Showtime::pluck('showtime_id');

        for ($i = 0; $i < 10; $i++) {
            $showtimeId = $showtimeIds->random();
            $row        = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'][array_rand(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'])];
            $seatNumber = $row . ($i + 1);

            Booking::firstOrCreate(
                ['showtime_id' => $showtimeId, 'seat_number' => $seatNumber],
                [
                    'user_id'      => $userIds->random(),
                    'booking_date' => now()->subDays(rand(0, 30)),
                    'status'       => $i < 7 ? 'confirmed' : 'cancelled',
                ]
            );
        }
    }
}
