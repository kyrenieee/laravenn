<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen" x-data="{}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Today's Showtimes Section -->
            @if($todayShowtimes->count() > 0)
            <div class="mb-12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-blue-500">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-900 dark:to-indigo-900">
                        <h3 class="text-xl font-bold text-white">Today's Showtimes</h3>
                        <p class="text-blue-100 text-sm mt-1">{{ now()->format('l, M d, Y') }}</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($todayShowtimes as $showtime)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-bold text-gray-900 dark:text-white text-left">{{ $showtime->movie->title }}</h4>
                                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs rounded-full font-semibold whitespace-nowrap ml-2">
                                        {{ $showtime->start_time->format('h:i A') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 text-left">Hall {{ $showtime->hall->hall_number }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1 text-left">{{ $showtime->movie->genre }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Action Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- View All Movies & Showtimes -->
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v10a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h3a1 1 0 000-2h-2.5A2 2 0 0113 2h-2a2 2 0 00-2-2H9a2 2 0 00-2 2H4.5A2 2 0 002 4v1a2 2 0 002 0h2a1 1 0 000-2H4z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Browse All Movies</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">View all available movies and upcoming showtimes</p>
                    <a href="{{ route('showtimes.index') }}"
                        class="w-full inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                        🎬 Browse Showtimes
                    </a>
                </div>

                <!-- Your Bookings -->
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v10a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h3a1 1 0 000-2h-2.5A2 2 0 0113 2h-2a2 2 0 00-2-2H9a2 2 0 00-2 2H4.5A2 2 0 002 4v1a2 2 0 002 0h2a1 1 0 000-2H4z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Your Tickets</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">View your booked tickets and reservations</p>
                    <a href="{{ route('bookings.index') }}"
                        class="w-full inline-block bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                        🎫 My Tickets
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Booking Modal Components for Today's Showtimes -->
    @foreach($todayShowtimes as $showtime)
        <x-seat-selection-modal :movie="$showtime->movie" :showtime="$showtime" />
        <x-booking-summary-modal :movie="$showtime->movie" :showtime="$showtime" />
    @endforeach

</x-app-layout>

