<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Halls Management') }}
            </h2>
            <a href="{{ route('admin.halls.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Hall
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">Hall Number</th>
                                <th class="px-4 py-3 text-left">Total Seats</th>
                                <th class="px-4 py-3 text-left">Seats Assigned</th>
                                <th class="px-4 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($halls as $hall)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $hall->hall_number }}</td>
                                <td class="px-4 py-3">{{ $hall->total_seats }}</td>
                                <td class="px-4 py-3">{{ $hall->seats()->count() }}</td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('admin.halls.edit', $hall) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.halls.delete', $hall) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure? This will delete all seats in this hall.')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
