<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-green-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($groupedBookings->isEmpty())
            <!-- Empty State -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 dark:from-green-900 dark:to-emerald-900">
                    <h3 class="text-2xl font-bold text-white">Your Booked Tickets</h3>
                </div>

                <div class="p-12 text-center">
                    <svg class="w-20 h-20 text-gray-300 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m-4 0v2m4 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Tickets Yet</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">You haven't booked any movie tickets yet.</p>

                    <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        🎬 Browse Movies & Book Tickets
                    </a>
                </div>
            </div>
            @else
            <div class="space-y-6">
                <!-- Tickets Overview -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 dark:from-green-900 dark:to-emerald-900">
                        <h3 class="text-2xl font-bold text-white">Your Booked Tickets</h3>
                        <p class="text-green-100 text-sm mt-1">You have <span class="font-bold">{{ $groupedBookings->count() }}</span> ticket(s) booked</p>
                    </div>

                    <div class="p-6 space-y-4">
                        @foreach ($groupedBookings as $showtimeId => $bookings)
                        @php
                            // All bookings in this group share the same showtime, so we can get details from the first one.
                            $firstBooking = $bookings->first();
                            $showtime = $firstBooking->showtime;
                            $totalPrice = $bookings->sum('price');
                        @endphp

                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 rounded-lg p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                <!-- Movie & Showtime Info -->
                                <div class="flex-1">
                                    <div class="flex items-start gap-4">
                                        <!-- Movie Poster -->
                                        <img src="{{ $showtime->movie->image_url }}" alt="{{ $showtime->movie->title }}" class="w-20 h-28 rounded object-cover shadow">

                                        <!-- Ticket Details -->
                                        <div class="flex-1">
                                            <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $showtime->movie->title }}</h4>

                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                                <div>
                                                    <p class="text-gray-600 dark:text-gray-400 text-xs uppercase tracking-wide">Date</p>
                                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $showtime->start_time->format('M d, Y') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600 dark:text-gray-400 text-xs uppercase tracking-wide">Time</p>
                                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $showtime->start_time->format('h:i A') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600 dark:text-gray-400 text-xs uppercase tracking-wide">Hall</p>
                                                    <p class="font-semibold text-gray-900 dark:text-white">Hall {{ $showtime->hall->hall_number }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600 dark:text-gray-400 text-xs uppercase tracking-wide">Seat</p>
                                                    <p class="font-semibold text-gray-900 dark:text-white text-lg">{{ $bookings->map(fn($b) => $b->seat->row . $b->seat->number)->join(', ') }}</p>
                                                </div>
                                            </div>

                                            <!-- Additional Info -->
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded-full font-semibold">
                                                    {{ $showtime->movie->genre }}
                                                </span>
                                                <span class="inline-block px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs rounded-full font-semibold">
                                                    {{ $showtime->movie->duration }} min
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price & Status -->
                                <div class="flex flex-col items-end gap-4">
                                    <div class="text-right">
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">Total Price Paid</p>
                                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">${{ number_format($totalPrice, 2) }}</p>
                                    </div>
                                    <div class="flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-900 rounded-full">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-semibold text-green-700 dark:text-green-300">Confirmed</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Date -->
                            <div class="mt-4 pt-4 border-t border-green-200 dark:border-green-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Booked on {{ $firstBooking->created_at->format('F d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Back to Dashboard -->
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        ← Back to Movies
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
