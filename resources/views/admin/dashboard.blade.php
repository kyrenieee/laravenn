<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Movies</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $data['totalMovies'] }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Halls</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $data['totalHalls'] }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Bookings</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $data['totalBookings'] }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Revenue</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">${{ number_format($data['totalRevenue'], 2) }}</div>
                </div>
            </div>

            <!-- Management Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Movies Management -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Movies Management</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Manage cinema movies</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.movies') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View All Movies
                            </a>
                            <a href="{{ route('admin.movies.create') }}" class="block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add New Movie
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Halls Management -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Halls Management</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Manage cinema halls and seats</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.halls') }}" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View All Halls
                            </a>
                            <a href="{{ route('admin.halls.create') }}" class="block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add New Hall
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Bookings</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="px-4 py-2 text-left">User</th>
                                    <th class="px-4 py-2 text-left">Showtime</th>
                                    <th class="px-4 py-2 text-left">Seat</th>
                                    <th class="px-4 py-2 text-left">Price</th>
                                    <th class="px-4 py-2 text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['recentBookings'] as $booking)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $booking->user->name }}</td>
                                    <td class="px-4 py-2">Movie {{ $booking->showtime->movie_id }}</td>
                                    <td class="px-4 py-2">{{ $booking->seat->row }}{{ $booking->seat->number }}</td>
                                    <td class="px-4 py-2">${{ number_format($booking->price, 2) }}</td>
                                    <td class="px-4 py-2">{{ $booking->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
