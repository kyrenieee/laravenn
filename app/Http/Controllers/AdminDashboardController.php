<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\halls;
use App\Models\movies;
use App\Models\seats;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Dashboard Overview
    public function index()
    {
        $data = [
            'totalMovies' => movies::count(),
            'totalHalls' => halls::count(),
            'totalBookings' => bookings::count(),
            'totalRevenue' => bookings::sum('price'),
            'movies' => movies::all(),
            'halls' => halls::all(),
            'recentBookings' => bookings::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('data'));
    }

    // Movies Management
    public function movies()
    {
        $movies = movies::all();
        $halls = halls::all();

        return view('admin.movies.index', compact('movies', 'halls'));
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'director' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'image_url' => 'required|url',
            'hall_id' => 'required|exists:halls,id',
        ]);

        movies::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Movie added successfully!']);
        }

        return redirect()->route('admin.movies')->with('success', 'Movie added successfully!');
    }

    public function editMovie(movies $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, movies $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'director' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'release_date' => 'required|date',
            'image_url' => 'required|url',
            'hall_id' => 'required|exists:halls,id',
        ]);

        $movie->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Movie updated successfully!']);
        }

        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully!');
    }

    public function deleteMovie(movies $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully!');
    }

    // Halls Management
    public function halls()
    {
        $halls = halls::all();

        return view('admin.halls.index', compact('halls'));
    }

    public function createHall()
    {
        return view('admin.halls.create');
    }

    public function storeHall(Request $request)
    {
        $validated = $request->validate([
            'hall_number' => 'required|string|max:100|unique:halls',
            'total_seats' => 'required|integer|min:1',
        ]);

        $hall = halls::create($validated);

        // Create a structured grid of seats for this hall
        if ($validated['total_seats'] > 0) {
            $seatsToCreate = [];
            $rows = range('A', 'J'); // Up to 10 rows
            $seatsPerRow = 10; // Assuming a standard 10x10 grid or similar

            $seatCounter = 0;
            foreach ($rows as $row) {
                for ($number = 1; $number <= $seatsPerRow; $number++) {
                    if ($seatCounter >= $validated['total_seats']) {
                        break 2; // Exit both loops
                    }
                    $seatsToCreate[] = [
                        'hall_id' => $hall->id,
                        'row' => $row,
                        'number' => $number,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $seatCounter++;
                }
            }
            // Use a bulk insert for better performance
            seats::insert($seatsToCreate);
        }

        return redirect()->route('admin.halls')->with('success', 'Hall added successfully with seats!');
    }

    public function editHall(halls $hall)
    {
        return view('admin.halls.edit', compact('hall'));
    }

    public function updateHall(Request $request, halls $hall)
    {
        $validated = $request->validate([
            'hall_number' => 'required|string|max:100|unique:halls,hall_number,'.$hall->id,
            'total_seats' => 'required|integer|min:1',
        ]);

        $hall->update($validated);

        return redirect()->route('admin.halls')->with('success', 'Hall updated successfully!');
    }

    public function deleteHall(halls $hall)
    {
        $hall->delete();

        return redirect()->route('admin.halls')->with('success', 'Hall deleted successfully!');
    }
}
