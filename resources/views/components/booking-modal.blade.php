@props(['movie', 'showtimes'])

<x-modal name="booking-modal-{{ $movie->id }}" :show="false" maxWidth="2xl">
    <div>
        <div class="p-6 bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm border-b border-white/20 dark:border-white/10">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">Book Ticket</h2>
                <button @click="$dispatch('close-modal', 'booking-modal-{{ $movie->id }}')" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Movie Details -->
            <div class="space-y-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm rounded-lg p-4 border border-white/20 dark:border-white/10">
                        <div class="aspect-video rounded-lg overflow-hidden bg-gray-200 dark:bg-slate-700">
                            <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Title</label>
                            <p class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">{{ $movie->title }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Genre</label>
                            <p class="text-gray-600 dark:text-gray-400">{{ $movie->genre }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Director</label>
                            <p class="text-gray-600 dark:text-gray-400">{{ $movie->director }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Duration</label>
                            <p class="text-gray-600 dark:text-gray-400">{{ $movie->duration }} minutes</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-white/10 dark:border-white/5 pt-4">
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $movie->description }}</p>
                </div>
            </div>

            <!-- Showtime Selection -->
            <div class="space-y-4">
                <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">Select a Showtime</h3>

                <div class="space-y-3">
                    @forelse($showtimes as $showtime)
                    <button
                        @click="$dispatch('close-modal', 'booking-modal-{{ $movie->id }}'); $dispatch('open-modal', 'seat-selection-modal-{{ $showtime->id }}')"
                        class="w-full p-4 bg-gradient-to-r from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm border border-white/20 dark:border-white/10 rounded-lg hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-md transition-all text-left group"
                    >
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $showtime->start_time->format('l, M d') }} at {{ $showtime->start_time->format('h:i A') }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    Hall {{ $showtime->hall->hall_number }} • {{ $showtime->hall->name }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                                    {{ $showtime->bookings->count() }}/{{ $showtime->hall->total_seats }} booked
                                </p>
                                <div class="w-16 h-2 bg-gray-200 dark:bg-slate-700 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-600 to-cyan-600" style="width: {{ ($showtime->bookings->count() / $showtime->hall->total_seats) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </button>
                    @empty
                    <div class="bg-gradient-to-br from-yellow-50/50 to-orange-50/30 dark:from-yellow-900/30 dark:to-orange-900/20 supports-backdrop-filter:backdrop-blur-sm p-4 rounded-lg border border-yellow-200 dark:border-yellow-800/50">
                        <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                            <strong>No showtimes available</strong> for this movie. Please check back later.
                        </p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-end pt-6 border-t border-white/10 dark:border-white/5 mt-6">
                <button type="button" @click="$dispatch('close-modal', 'booking-modal-{{ $movie->id }}')"
                    class="px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700/70 transition-all supports-backdrop-filter:backdrop-blur-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</x-modal>
