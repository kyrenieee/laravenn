<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Booking Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-b from-green-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Receipt Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border-2 border-green-500">
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-900 dark:to-emerald-900 px-8 py-6">
                    <div class="text-center">
                        <div class="flex justify-center mb-3">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v10a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h3a1 1 0 000-2h-2.5A2 2 0 0113 2h-2a2 2 0 00-2-2H9a2 2 0 00-2 2H4.5A2 2 0 002 4v1a2 2 0 002 0h2a1 1 0 000-2H4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-white">✓ Booking Confirmed</h1>
                        <p class="text-green-100 text-sm mt-2">Your seats have been reserved</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 space-y-6" x-data="ticketReceipt()" x-init="init()">
                    <!-- Booking Reference -->
                    <div class="bg-gradient-to-br from-white/50 to-green-50/30 dark:from-slate-800/50 dark:to-green-900/20 p-6 rounded-lg border border-green-200 dark:border-green-800/50">
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Booking Reference</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white font-mono" x-text="bookingRef"></p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Save this reference for your records</p>
                    </div>

                    <!-- Movie & Showtime -->
                    <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 p-6 rounded-lg border border-white/20 dark:border-white/10">
                        <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent mb-4">Movie Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Movie</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="movieTitle"></p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Showtime</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="showtime"></p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Hall</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="hall"></p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Date</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="date"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Seats -->
                    <div class="bg-gradient-to-br from-white/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/20 p-6 rounded-lg border border-white/20 dark:border-white/10">
                        <h3 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent mb-4">Your Seats</h3>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="seat in seats" :key="seat">
                                <span class="px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg shadow-md">
                                    <span x-text="seat"></span>
                                </span>
                            </template>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">
                            <strong x-text="seats.length"></strong> seat<span x-text="seats.length !== 1 ? 's' : ''"></span> booked
                        </p>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 dark:from-green-900/40 dark:to-emerald-900/40 p-6 rounded-lg border-2 border-green-200 dark:border-green-800/50">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 dark:text-gray-300">Price per Seat:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="'$' + pricePerSeat.toFixed(2)"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 dark:text-gray-300">Quantity:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="seats.length + ' seat' + (seats.length !== 1 ? 's' : '')"></span>
                            </div>
                            <div class="border-t-2 border-green-300 dark:border-green-700 pt-3 mt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">Total Amount:</span>
                                    <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent" x-text="'$' + (seats.length * pricePerSeat).toFixed(2)"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 p-4 rounded">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            <strong>Important:</strong> Please arrive at least 15 minutes before the showtime. Your seats will be held until 10 minutes before the movie starts.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between gap-3 pt-6">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700/70 transition-all supports-backdrop-filter:backdrop-blur-sm">
                            ← Back to Dashboard
                        </a>

                        <button type="button" @click="printTicket()"
                            class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all shadow-lg shadow-green-500/30">
                            🖨️ Print Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function ticketReceipt() {
            return {
                bookingRef: 'Loading...',
                movieTitle: '',
                showtime: '',
                hall: '',
                date: '',
                seats: [],
                pricePerSeat: 15,

                init() {
                    this.loadBookingData();
                },

                loadBookingData() {
                    // Get data from all showtimes' sessionStorage
                    for (let key in sessionStorage) {
                        if (key.startsWith('seats_')) {
                            const data = JSON.parse(sessionStorage.getItem(key));
                            if (data && data.seats) {
                                this.seats = data.seats;
                                this.pricePerSeat = data.price || 15;

                                // Generate booking reference
                                const timestamp = Date.now().toString().slice(-8);
                                this.bookingRef = 'BK' + timestamp.toUpperCase();

                                // Get showtime details from page data (you can pass this via props)
                                // For now, we'll use placeholder data
                                this.movieTitle = 'Movie Title';
                                this.showtime = new Date().toLocaleTimeString('en-US', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true
                                });
                                this.date = new Date().toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                this.hall = 'Cinema Hall A';
                                break;
                            }
                        }
                    }
                },

                printTicket() {
                    window.print();
                }
            }
        }
    </script>

    <style>
        @media print {
            body {
                background: white;
            }
            .dark {
                color-scheme: light;
            }
        }
    </style>
</x-app-layout>
