<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use Illuminate\Support\Facades\DB;
use App\Models\showtimes;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function getShowtimeSeats(showtimes $showtime)
    {
        try {
            // Ensure the showtime has an associated hall
            if (!$showtime->hall) {
                return response()->json([
                    'success' => false,
                    'message' => 'Showtime has no associated hall.',
                ], 404);
            }
            $seats = $showtime->hall->seats()->orderBy('row')->orderBy('number')->get();
            $bookedSeats = bookings::where('showtime_id', $showtime->id)->pluck('seats_id')->toArray();

            return response()->json([
                'success' => true,
                'showtime' => [
                    'id' => $showtime->id,
                    'time' => $showtime->start_time->format('M d, Y - h:i A'),
                    'hall_name' => 'Hall ' . $showtime->hall->hall_number,
                    'price' => 15,
                ],
                'seats' => $seats->map(fn ($seat) => [
                    'id' => $seat->id,
                    'row' => $seat->row,
                    'number' => $seat->number,
                ])->toArray(),
                'bookedSeats' => $bookedSeats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading seats: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array|min:1',
            // This now validates the 'id' field within each object in the 'seats' array.
            'seats.*.id' => 'required|integer|exists:seats,id',
        ]);

        try {
            // Extract just the seat IDs from the array of seat objects.
            $seatIds = collect($validated['seats'])->pluck('id')->all();

            // Using a transaction to ensure all bookings are created or none are.
            return DB::transaction(function () use ($validated, $request, $seatIds) {
                $showtime = showtimes::where('id', $validated['showtime_id'])
                    ->lockForUpdate() // Lock to prevent race conditions on booking.
                    ->firstOrFail();

                // Check if any of the requested seats are already booked for this showtime.
                $isAlreadyBooked = bookings::where('showtime_id', $showtime->id)
                    ->whereIn('seats_id', $seatIds)
                    ->exists();

                if ($isAlreadyBooked) {
                    // Using a 409 Conflict status code is appropriate here.
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, one or more of your selected seats has just been booked. Please select different seats.',
                    ], 409);
                }

                // Price should be determined by the server, not the client.
                $pricePerSeat = 15;
                $userId = $request->user()->id;

                $bookingsToCreate = collect($seatIds)->map(fn ($seatId) => [
                    'users_id' => $userId,
                    'showtime_id' => $showtime->id,
                    'seats_id' => $seatId,
                    'price' => $pricePerSeat,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->all();

                bookings::insert($bookingsToCreate);

                return response()->json([
                    'success' => true,
                    'message' => 'Booking successful!',
                ]);
            });
        } catch (\Exception $e) {
            // The transaction would have been rolled back automatically.
            return response()->json([
                'success' => false,
                'message' => 'Error creating booking: '.$e->getMessage(),
            ], 500);
        }
    }
}
