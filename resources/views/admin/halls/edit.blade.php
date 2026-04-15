<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Hall') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.halls.update', $hall) }}">
                        @csrf
                        @method('PUT')

                        <!-- Hall Number -->
                        <div class="mb-4">
                            <label for="hall_number" class="block text-sm font-medium mb-1">Hall Number</label>
                            <input type="text" id="hall_number" name="hall_number" value="{{ old('hall_number', $hall->hall_number) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('hall_number') border-red-500 @enderror" required>
                            @error('hall_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Total Seats -->
                        <div class="mb-4">
                            <label for="total_seats" class="block text-sm font-medium mb-1">Total Seats</label>
                            <input type="number" id="total_seats" name="total_seats" value="{{ old('total_seats', $hall->total_seats) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('total_seats') border-red-500 @enderror" required>
                            <small class="text-gray-500">Current seats assigned: {{ $hall->seats()->count() }}</small>
                            @error('total_seats') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Hall
                            </button>
                            <a href="{{ route('admin.halls') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
