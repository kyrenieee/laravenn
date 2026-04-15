<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-6">Available Movies</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($movies as $movie)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-full h-48 object-contain">
                            <div class="p-4">
                                <h4 class="text-xl font-semibold mb-2">{{ $movie->title }}</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">Release: {{ $movie->release_date->format('M d, Y') }}</p>
                                <button
                                    @click="$dispatch('open-modal', { name: 'movie-modal-{{ $movie->id }}' })"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Get Ticket
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($movies as $movie)
    <x-modal name="movie-modal-{{ $movie->id }}" :show="false" maxWidth="2xl">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $movie->title }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-full rounded-lg object-contain">
                </div>
                <div>
                    <p class="mb-2"><strong>Description:</strong> {{ $movie->description }}</p>
                    <p class="mb-2"><strong>Genre:</strong> {{ $movie->genre }}</p>
                    <p class="mb-2"><strong>Director:</strong> {{ $movie->director }}</p>
                    <p class="mb-2"><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                    <p class="mb-2"><strong>Release Date:</strong> {{ $movie->release_date->format('F d, Y') }}</p>
                    <p class="mb-4"><strong>Price:</strong> $15.00</p>

                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Purchase Ticket
                    </button>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button @click="$dispatch('close-modal', { name: 'movie-modal-{{ $movie->id }}' })" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </x-modal>
    @endforeach
</x-app-layout>
