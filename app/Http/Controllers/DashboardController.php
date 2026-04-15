<?php

namespace App\Http\Controllers;

use App\Models\movies as movie;

class DashboardController extends Controller
{
    public function index()
    {
        return view('page.dashboard', [
            'movies' => movie::all(),
        ]);
    }
}
