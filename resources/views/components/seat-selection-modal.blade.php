@props(['movie', 'showtime'])

<x-modal name="seat-selection-modal-{{ $showtime->id }}" :show="false" maxWidth="4xl">
    <div x-data="seatSelection({{ $showtime->id }})" x-init="init()">
        <div class="p-6 bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm border-b border-white/20 dark:border-white/10">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">Select Your Seats</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $movie->title }} • {{ $showtime->start_time->format('M d, Y - h:i A') }}</p>
                </div>
                <button @click="$dispatch('close-modal', 'seat-selection-modal-{{ $showtime->id }}')" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <form @submit.prevent="submitSeats" class="p-8">
            @csrf

            <div class="space-y-8">
                <!-- Screen -->
                <div class="text-center">
                    <div class="inline-block bg-gradient-to-r from-gray-400 to-gray-500 dark:from-gray-600 dark:to-gray-700 rounded-full px-8 py-3 mb-12">
                        <p class="text-white font-bold text-sm tracking-widest">SCREEN</p>
                    </div>
                </div>

                <!-- Seat Grid -->
                <div class="flex justify-center">
                    <div x-show="isLoading" class="text-center py-10">
                        <p class="text-gray-600 dark:text-gray-400">Loading seats...</p>
                    </div>
                    <div x-show="!isLoading" class="inline-block space-y-3">
                        <template x-for="[row, seats] in seatRows" :key="row">
                            <div class="flex items-center gap-2 justify-center">
                                <!-- Row Label -->
                                <span class="w-6 text-center font-bold text-gray-700 dark:text-gray-300 text-sm" x-text="row"></span>

                                <!-- Seats in Row -->
                                <template x-for="seat in seats" :key="seat.id">
                                    <button type="button" @click="toggleSeat(seat)" :disabled="isBooked(seat)" :class="seatClass(seat)" x-text="seat.number"></button>
                                </template>
                            </div>
                        </template>
                        <div x-show="seatRows.length === 0 && !isLoading" class="text-center py-10">
                            <p class="text-gray-600 dark:text-gray-400">No seats available for this hall.</p>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="flex justify-center gap-8 pt-6 border-t border-white/10 dark:border-white/5">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Available</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Selected</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gray-400 dark:bg-gray-600 rounded-lg opacity-50"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Booked</span>
                    </div>
                </div>

                <!-- Selected Seats Summary -->
                <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 supports-backdrop-filter:backdrop-blur-sm p-6 rounded-lg border border-white/20 dark:border-white/10">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Selected Seats:</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="selectedSeats.length > 0 ? selectedSeats.map(s => s.row + s.number).join(', ') : 'No seats selected'"></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
                        <span x-text="selectedSeats.length"></span> seat<span x-text="selectedSeats.length !== 1 ? 's' : ''"></span> selected
                    </p>
                </div>

                <!-- Price Info -->
                <div class="bg-gradient-to-r from-blue-500/20 to-cyan-500/20 dark:from-blue-900/40 dark:to-cyan-900/40 supports-backdrop-filter:backdrop-blur-sm rounded-lg p-4 border border-blue-200 dark:border-blue-800/50">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Total Price:</span>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent" x-text="'$' + (selectedSeats.length * ticketPrice).toFixed(2)"></span>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-6 border-t border-white/10 dark:border-white/5 gap-3">
                    <button type="button" @click="$dispatch('close-modal', 'seat-selection-modal-{{ $showtime->id }}')"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700/70 transition-all supports-backdrop-filter:backdrop-blur-sm">
                        Cancel
                    </button>

                    <button type="submit" :disabled="selectedSeats.length === 0"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg hover:from-green-700 hover:to-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-lg shadow-green-500/30">
                        Continue with <span x-text="selectedSeats.length"></span> Seat<span x-text="selectedSeats.length !== 1 ? 's' : ''"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function seatSelection(showtimeId) {
            return {
                isLoading: true,
                selectedSeats: [], // Array of seat objects: {id, row, number}
                bookedSeatIds: [],
                allSeats: [], // Array of all seat objects for the hall
                seatRows: [], // Will be [ ['A', [seat, seat]], ['B', [seat, seat]] ]
                ticketPrice: 15,

                init() {
                    this.loadSeats();
                },

                loadSeats() {
                    this.isLoading = true;
                    fetch(`/api/showtimes/${showtimeId}/seats`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (!data.success) {
                                throw new Error(data.message || 'API returned success=false');
                            }
                            this.allSeats = data.seats || [];
                            this.bookedSeatIds = data.bookedSeats || [];
                            this.ticketPrice = data.showtime?.price || 15;

                            console.log('Seats loaded:', this.allSeats.length, 'seats, booked:', this.bookedSeatIds.length);

                            // Group seats by row for dynamic rendering
                            const rows = this.allSeats.reduce((acc, seat) => {
                                acc[seat.row] = acc[seat.row] || [];
                                acc[seat.row].push(seat);
                                return acc;
                            }, {});

                            // Sort seats within each row by number
                            for (const row in rows) {
                                rows[row].sort((a, b) => a.number - b.number);
                            }

                            // Sort rows and store as an array of [key, value] pairs
                            this.seatRows = Object.entries(rows).sort(([rowA], [rowB]) => rowA.localeCompare(rowB));
                        })
                        .catch(error => {
                            console.error('Error loading seats:', error);
                            alert('Failed to load seats: ' + error.message);
                        })
                        .finally(() => {
                            this.isLoading = false;
                        });
                },

                isBooked(seat) {
                    return this.bookedSeatIds.includes(seat.id);
                },

                isSelected(seat) {
                    return this.selectedSeats.some(s => s.id === seat.id);
                },

                seatClass(seat) {
                    const baseClass = 'w-8 h-8 rounded-lg font-semibold text-xs transition-all supports-backdrop-filter:backdrop-blur-sm';

                    if (this.isBooked(seat)) {
                        return baseClass + ' bg-gray-500 dark:bg-gray-600 text-gray-300 dark:text-gray-400 opacity-75 cursor-not-allowed border border-gray-400 dark:border-gray-500';
                    }

                    if (this.isSelected(seat)) {
                        return baseClass + ' bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/50 border border-blue-500 font-bold';
                    }

                    return baseClass + ' bg-white/60 dark:bg-slate-700/60 border-2 border-gray-300 dark:border-slate-500 text-gray-900 dark:text-white hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 cursor-pointer';
                },

                toggleSeat(seat) {
                    if (this.isBooked(seat)) return;

                    const seatIndex = this.selectedSeats.findIndex(s => s.id === seat.id);

                    if (seatIndex > -1) {
                        this.selectedSeats.splice(seatIndex, 1);
                    } else {
                        this.selectedSeats.push(seat);
                    }
                },

                submitSeats() {
                    if (this.selectedSeats.length === 0) {
                        alert('Please select at least one seat');
                        return;
                    }

                    // Store full seat objects in sessionStorage
                    const bookingData = {
                        seats: this.selectedSeats, // This is now an array of objects
                        price: this.ticketPrice,
                    };
                    sessionStorage.setItem(`seats_${showtimeId}`, JSON.stringify(bookingData));

                    // Open booking summary modal
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: `seat-selection-modal-${showtimeId}` }));
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: `booking-summary-modal-${showtimeId}` }));
                    }, 300);
                }
            }
        }
    </script>
</x-modal>
