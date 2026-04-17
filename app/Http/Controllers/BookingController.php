<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userBookings = auth()->user()->bookings()
            ->with('showtime.movie', 'showtime.hall', 'seat')
            ->orderByDesc('created_at')
            ->get();

        // Group bookings by showtime to represent a single "ticket" per show.
        $groupedBookings = $userBookings->groupBy('showtime_id');

        return view('bookings.index', [
            'groupedBookings' => $groupedBookings,
        ]);
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
    public function show(bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bookings $bookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bookings $bookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bookings $bookings)
    {
        //
    }
}
