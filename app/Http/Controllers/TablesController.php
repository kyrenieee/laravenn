<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\halls;
use App\Models\movies;
use App\Models\seats;
use App\Models\showtimes;
use App\Models\User;

class TablesController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all(),
            'movies' => movies::all(),
            'halls' => halls::all(),
            'seats' => seats::all(),
            'bookings' => bookings::all(),
            'showtimes' => showtimes::all(),
        ];

        return view('tables', compact('data'));
    }
}
