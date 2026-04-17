<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Showtimes & Movies') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen" x-data="{}">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Movies Grid with Showtimes -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Available Movies</h3>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd"></path>
                        </svg>
                        Upcoming Showtimes
                    </div>
                </div>

                            <!-- Today's Showtimes Section -->
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full"></div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Today's Showtimes</h3>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ now()->format('l, F d, Y') }}
                    </div>
                </div>

                @php
                    // Get today's showtimes from your existing data
                    $todayShowtimes = [];
                    foreach($movies as $movie) {
                        foreach($movie->showtimes as $showtime) {
                            if($showtime->start_time->isToday()) {
                                $todayShowtimes[] = $showtime;
                            }
                        }
                    }
                @endphp

                @if(count($todayShowtimes) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($todayShowtimes as $showtime)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:scale-[1.02]">
                        <div class="flex p-3 gap-3">
                            <!-- Movie Poster -->
                            <div class="w-16 h-20 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $showtime->movie->image_url }}" alt="{{ $showtime->movie->title }}" class="w-full h-full object-cover">
                            </div>
                            
                            <!-- Showtime Info -->
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $showtime->movie->title }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $showtime->movie->genre }}</p>
                                
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs rounded-full font-semibold">
                                        {{ $showtime->start_time->format('h:i A') }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Hall {{ $showtime->hall->hall_number ?? '1' }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-sm font-bold text-green-600 dark:text-green-400">₱{{ number_format($showtime->price ?? 300, 2) }}</span>
                                    <button 
                                        @click="$dispatch('open-modal', 'seat-selection-modal-{{ $showtime->id }}')"
                                        class="px-3 py-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white text-xs rounded-lg transition transform hover:scale-105">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">No showtimes available for today</p>
                    <p class="text-sm text-gray-400">Check back tomorrow for more showtimes!</p>
                </div>
                @endif
                
                <!-- View All Link -->
                <div class="text-center mt-6">
                    <a href="{{ route('showtimes.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium transition">
                        View All Showtimes
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($movies as $movie)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                        <!-- Movie Image -->
                        <div class="relative overflow-hidden h-64 bg-gray-200 dark:bg-gray-700">
                            <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white text-sm font-medium">{{ $movie->genre }}</p>
                            </div>
                        </div>

                        <!-- Movie Info -->
                        <div class="p-5">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $movie->title }}</h4>

                            <div class="space-y-2 text-sm mb-4">
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                    </svg>
                                    <span>{{ $movie->duration }} min</span>
                                </div>
                                <div class="flex items-center text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $movie->release_date->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Director -->
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-1">by {{ $movie->director }}</p>

                            <!-- Showtimes -->
                            <div class="space-y-2 mb-4">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Available Showtimes:</p>
                                <div class="space-y-2">
                                    @forelse($movie->showtimes as $showtime)
                                    <button
                                        @click="$dispatch('open-modal', 'seat-selection-modal-{{ $showtime->id }}')"
                                        class="w-full p-2 text-sm bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-lg transition"
                                    >
                                        {{ $showtime->start_time->format('h:i A') }} - Hall {{ $showtime->hall->hall_number }}
                                    </button>
                                    @empty
                                    <p class="text-sm text-gray-500 dark:text-gray-400 italic">No showtimes available</p>
                                    @endforelse
                                </div>
                            </div>
                            <!-- Get Ticket Button -->
                            <button
                                @click="$dispatch('open-modal', 'booking-modal-{{ $movie->id }}')"
                                class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105"
                            >
                                🎫 View & Book
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Booking Modal Components -->
    @foreach($movies as $movie)
        <x-booking-modal :movie="$movie" :showtimes="$movie->showtimes" />
        @foreach($movie->showtimes as $showtime)
            <x-seat-selection-modal :movie="$movie" :showtime="$showtime" />
            <x-booking-summary-modal :movie="$movie" :showtime="$showtime" />
        @endforeach
    @endforeach

</x-app-layout>
