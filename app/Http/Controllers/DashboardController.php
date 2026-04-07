<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Theater;

class DashboardController extends Controller
{
    public function index()
    {
        return view('page.dashboard', [
            'movies'    => Movie::all(),
            'theaters'  => Theater::all(),
            'showtimes' => Showtime::with(['movie', 'theater'])->get(),
            'bookings'  => Booking::with(['user', 'showtime.movie'])->get(),
        ]);
    }
}
