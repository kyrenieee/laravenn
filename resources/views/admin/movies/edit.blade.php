<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.movies.update', $movie) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium mb-1">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('title') border-red-500 @enderror" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium mb-1">Description</label>
                            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('description') border-red-500 @enderror" required>{{ old('description', $movie->description) }}</textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Genre -->
                        <div class="mb-4">
                            <label for="genre" class="block text-sm font-medium mb-1">Genre</label>
                            <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('genre') border-red-500 @enderror" required>
                            @error('genre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Director -->
                        <div class="mb-4">
                            <label for="director" class="block text-sm font-medium mb-1">Director</label>
                            <input type="text" id="director" name="director" value="{{ old('director', $movie->director) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('director') border-red-500 @enderror" required>
                            @error('director') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium mb-1">Duration (minutes)</label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('duration') border-red-500 @enderror" required>
                            @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Release Date -->
                        <div class="mb-4">
                            <label for="release_date" class="block text-sm font-medium mb-1">Release Date</label>
                            <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('release_date') border-red-500 @enderror" required>
                            @error('release_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image URL -->
                        <div class="mb-6">
                            <label for="image_url" class="block text-sm font-medium mb-1">Image URL</label>
                            <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $movie->image_url) }}" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('image_url') border-red-500 @enderror" required>
                            @error('image_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Movie
                            </button>
                            <a href="{{ route('admin.movies') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
