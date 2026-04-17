<?php

namespace App\Http\Controllers;

use App\Models\movies as movie;
use App\Models\showtimes;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get movies that have showtimes
        $movies = movie::with('showtimes.hall', 'showtimes.bookings')
            ->whereHas('showtimes')
            ->get();

        // Get showtimes for today
        $today = Carbon::today();
        $todayShowtimes = showtimes::whereDate('start_time', $today)
            ->with('movie', 'hall', 'bookings')
            ->orderBy('start_time')
            ->get();

        return view('page.dashboard', [
            'movies' => $movies,
            'todayShowtimes' => $todayShowtimes,
        ]);
    }
}
