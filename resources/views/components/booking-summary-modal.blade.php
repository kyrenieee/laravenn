@props(['movie', 'showtime'])

<x-modal name="booking-summary-modal-{{ $showtime->id }}" :show="false" maxWidth="2xl">
    <div>
        <div class="p-6 bg-gradient-to-br from-white/50 to-green-50/30 dark:from-slate-800/50 dark:to-green-900/20 supports-backdrop-filter:backdrop-blur-sm border-b border-white/20 dark:border-white/10">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent">Booking Summary</h2>
                <button @click="$dispatch('close-modal', 'booking-summary-modal-{{ $showtime->id }}')" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6" x-data="bookingSummary({{ $showtime->id }})" x-init="setupModalListener()">
            <div class="space-y-6">
                <!-- Movie Details -->
                <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm p-6 rounded-lg border border-white/20 dark:border-white/10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Movie</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $movie->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Showtime</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $showtime->start_time->format('M d, Y - h:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Hall</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">Hall {{ $showtime->hall->hall_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Price per Seat</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="'$' + ticketPrice.toFixed(2)"></p>
                        </div>
                    </div>
                </div>

                <!-- Selected Seats -->
                <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm p-6 rounded-lg border border-white/20 dark:border-white/10">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Selected Seats</p>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="seat in selectedSeats" :key="seat.id">
                            <span class="px-3 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-sm font-semibold rounded-lg">
                                <span x-text="seat.row + seat.number"></span>
                            </span>
                        </template>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">
                        <strong x-text="selectedSeats.length"></strong> seat<span x-text="selectedSeats.length !== 1 ? 's' : ''"></span>
                    </p>
                </div>

                <!-- Price Breakdown -->
                <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 dark:from-green-900/40 dark:to-emerald-900/40 supports-backdrop-filter:backdrop-blur-sm rounded-lg p-6 border border-green-200 dark:border-green-800/50">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 dark:text-gray-300">Subtotal (<span x-text="selectedSeats.length"></span> seats × $<span x-text="ticketPrice.toFixed(2)"></span>):</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="'$' + (selectedSeats.length * ticketPrice).toFixed(2)"></span>
                        </div>
                        <div class="border-t border-green-200 dark:border-green-800/50 pt-3 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Total Amount:</span>
                                <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent" x-text="'$' + (selectedSeats.length * ticketPrice).toFixed(2)"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between gap-3 pt-6 border-t border-white/10 dark:border-white/5">
                    <button type="button" @click="goBack()"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700/70 transition-all supports-backdrop-filter:backdrop-blur-sm">
                        Back to Seats
                    </button>

                    <button type="button" @click="confirmBooking()"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all shadow-lg shadow-green-500/30">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bookingSummary(showtimeId) {
            return {
                selectedSeats: [], // Array of seat objects {id, row, number}
                ticketPrice: 15,

                setupModalListener() {
                    window.addEventListener('open-modal', (event) => {
                        if (event.detail === `booking-summary-modal-${showtimeId}`) {
                            setTimeout(() => this.init(), 50);
                        }
                    });
                },

                init() {
                    const seatsData = sessionStorage.getItem(`seats_${showtimeId}`);

                    if (seatsData) {
                        const data = JSON.parse(seatsData);
                        this.selectedSeats = data.seats || []; // This is now an array of objects
                        this.ticketPrice = data.price || 15;
                    } else {
                        console.warn('No booking data found in sessionStorage');
                    }
                },

                goBack() {
                    // Close summary modal and reopen seat selection
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: `booking-summary-modal-${showtimeId}` }));
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: `seat-selection-modal-${showtimeId}` }));
                    }, 300);
                },

                confirmBooking() {
                    if (this.selectedSeats.length === 0) {
                        alert('No seats selected');
                        return;
                    }

                    // We already have the full seat objects. We just need to format them for the API.
                    const seatDataForApi = this.selectedSeats.map(seat => ({ id: seat.id }));

                    // POST to API
                    fetch('/api/bookings', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({
                            showtime_id: showtimeId,
                            seats: seatDataForApi, // e.g., [{id: 1}, {id: 2}]
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                // Try to parse error message from JSON response for better feedback
                                return response.json().then(err => {
                                    throw new Error(err.message || `API error: ${response.status} ${response.statusText}`);
                                }).catch(() => {
                                    // Fallback if the error response is not JSON
                                    throw new Error(`API error: ${response.status} ${response.statusText}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Clear sessionStorage
                                sessionStorage.removeItem(`seats_${showtimeId}`);

                                // Close modal
                                window.dispatchEvent(new CustomEvent('close-modal', { detail: `booking-summary-modal-${showtimeId}` }));

                                // Redirect to bookings page to see the new ticket
                                setTimeout(() => {
                                    window.location.href = '{{ route("tickets.index") }}';
                                }, 300);
                            } else {
                                alert('Error creating booking: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Booking error:', error);
                            alert('Error creating booking: ' + error.message);
                        });
                }
            }
        }
    </script>
</x-modal>
