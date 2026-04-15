@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Database Tables</h1>

    <!-- Users Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Users</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['users'] as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->role }}</td>
                        <td class="px-4 py-2 border">{{ $user->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Movies Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Movies</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Genre</th>
                        <th class="px-4 py-2 border">Director</th>
                        <th class="px-4 py-2 border">Duration</th>
                        <th class="px-4 py-2 border">Release Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['movies'] as $movie)
                    <tr>
                        <td class="px-4 py-2 border">{{ $movie->id }}</td>
                        <td class="px-4 py-2 border">{{ $movie->title }}</td>
                        <td class="px-4 py-2 border">{{ $movie->genre }}</td>
                        <td class="px-4 py-2 border">{{ $movie->director }}</td>
                        <td class="px-4 py-2 border">{{ $movie->duration }}</td>
                        <td class="px-4 py-2 border">{{ $movie->release_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Halls Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Halls</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Hall Number</th>
                        <th class="px-4 py-2 border">Total Seats</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['halls'] as $hall)
                    <tr>
                        <td class="px-4 py-2 border">{{ $hall->id }}</td>
                        <td class="px-4 py-2 border">{{ $hall->hall_number }}</td>
                        <td class="px-4 py-2 border">{{ $hall->total_seats }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Seats Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Seats</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Hall ID</th>
                        <th class="px-4 py-2 border">Row</th>
                        <th class="px-4 py-2 border">Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['seats'] as $seat)
                    <tr>
                        <td class="px-4 py-2 border">{{ $seat->id }}</td>
                        <td class="px-4 py-2 border">{{ $seat->hall_id }}</td>
                        <td class="px-4 py-2 border">{{ $seat->row }}</td>
                        <td class="px-4 py-2 border">{{ $seat->number }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Showtimes Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Showtimes</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Movie ID</th>
                        <th class="px-4 py-2 border">Hall ID</th>
                        <th class="px-4 py-2 border">Start Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['showtimes'] as $showtime)
                    <tr>
                        <td class="px-4 py-2 border">{{ $showtime->id }}</td>
                        <td class="px-4 py-2 border">{{ $showtime->movie_id }}</td>
                        <td class="px-4 py-2 border">{{ $showtime->hall_id }}</td>
                        <td class="px-4 py-2 border">{{ $showtime->start_time }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">User ID</th>
                        <th class="px-4 py-2 border">Showtime ID</th>
                        <th class="px-4 py-2 border">Seat ID</th>
                        <th class="px-4 py-2 border">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['bookings'] as $booking)
                    <tr>
                        <td class="px-4 py-2 border">{{ $booking->id }}</td>
                        <td class="px-4 py-2 border">{{ $booking->users_id }}</td>
                        <td class="px-4 py-2 border">{{ $booking->showtime_id }}</td>
                        <td class="px-4 py-2 border">{{ $booking->seats_id }}</td>
                        <td class="px-4 py-2 border">{{ $booking->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
