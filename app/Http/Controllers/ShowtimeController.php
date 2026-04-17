<?php

namespace App\Http\Controllers;

use App\Models\movies;
use App\Models\showtimes;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = movies::with('showtimes.hall')
            ->whereHas('showtimes')
            ->get();

        return view('showtimes.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(showtimes $showtimes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(showtimes $showtimes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, showtimes $showtimes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(showtimes $showtimes)
    {
        //
    }
}
