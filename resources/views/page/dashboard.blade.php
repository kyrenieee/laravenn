<x-app-layout>
<div class="min-h-screen bg-gray-950 text-gray-100 py-10 px-4">
    <div class="max-w-7xl mx-auto space-y-12">

        {{-- Page Header --}}
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Dashboard</h1>
            <p class="text-gray-400 mt-2 text-sm">Overview of all cinema data</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Movies',    'count' => $movies->count(),    'color' => 'red'],
                ['label' => 'Theaters',  'count' => $theaters->count(),  'color' => 'blue'],
                ['label' => 'Showtimes', 'count' => $showtimes->count(), 'color' => 'purple'],
                ['label' => 'Bookings',  'count' => $bookings->count(),  'color' => 'green'],
            ] as $stat)
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 text-center">
                <p class="text-3xl font-bold text-{{ $stat['color'] }}-500">{{ $stat['count'] }}</p>
                <p class="text-gray-400 text-sm mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Movies Table --}}
        <section>
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-red-500 pl-3">Movies</h2>
            <div class="overflow-x-auto rounded-xl border border-gray-800">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Title</th>
                            <th class="px-5 py-3">Genre</th>
                            <th class="px-5 py-3">Duration</th>
                            <th class="px-5 py-3">Release Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($movies as $movie)
                        <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                            <td class="px-5 py-3 text-gray-500">{{ $movie->movie_id }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $movie->title }}</td>
                            <td class="px-5 py-3">
                                <span class="bg-red-900/40 text-red-400 text-xs font-semibold px-2 py-0.5 rounded-full">
                                    {{ $movie->genre ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-300">{{ $movie->duration_minutes }} min</td>
                            <td class="px-5 py-3 text-gray-300">{{ \Carbon\Carbon::parse($movie->release_date)->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-5 py-6 text-center text-gray-500">No movies found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Theaters Table --}}
        <section>
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-blue-500 pl-3">Theaters</h2>
            <div class="overflow-x-auto rounded-xl border border-gray-800">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Capacity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($theaters as $theater)
                        <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                            <td class="px-5 py-3 text-gray-500">{{ $theater->theater_id }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $theater->name }}</td>
                            <td class="px-5 py-3 text-gray-300">{{ $theater->capacity }} seats</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-gray-500">No theaters found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Showtimes Table --}}
        <section>
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-purple-500 pl-3">Showtimes</h2>
            <div class="overflow-x-auto rounded-xl border border-gray-800">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Movie</th>
                            <th class="px-5 py-3">Theater</th>
                            <th class="px-5 py-3">Start Time</th>
                            <th class="px-5 py-3">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($showtimes as $showtime)
                        <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                            <td class="px-5 py-3 text-gray-500">{{ $showtime->showtime_id }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $showtime->movie->title ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-300">{{ $showtime->theater->name ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-300">{{ \Carbon\Carbon::parse($showtime->start_time)->format('M d, Y  h:i A') }}</td>
                            <td class="px-5 py-3">
                                <span class="text-purple-400 font-semibold">₱{{ number_format($showtime->price, 2) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-5 py-6 text-center text-gray-500">No showtimes found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Bookings Table --}}
        <section>
            <h2 class="text-xl font-bold text-white mb-4 border-l-4 border-green-500 pl-3">Bookings</h2>
            <div class="overflow-x-auto rounded-xl border border-gray-800">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Customer</th>
                            <th class="px-5 py-3">Movie</th>
                            <th class="px-5 py-3">Seat</th>
                            <th class="px-5 py-3">Booking Date</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($bookings as $booking)
                        <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                            <td class="px-5 py-3 text-gray-500">{{ $booking->booking_id }}</td>
                            <td class="px-5 py-3 font-medium text-white">{{ $booking->user->name ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-300">{{ $booking->showtime->movie->title ?? 'N/A' }}</td>
                            <td class="px-5 py-3">
                                <span class="bg-gray-700 text-gray-200 text-xs font-bold px-2 py-0.5 rounded">
                                    {{ $booking->seat_number }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-300">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                            <td class="px-5 py-3">
                                @if($booking->status === 'confirmed')
                                    <span class="bg-green-900/40 text-green-400 text-xs font-semibold px-2 py-0.5 rounded-full">Confirmed</span>
                                @else
                                    <span class="bg-red-900/40 text-red-400 text-xs font-semibold px-2 py-0.5 rounded-full">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-5 py-6 text-center text-gray-500">No bookings found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
</x-app-layout>
