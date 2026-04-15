<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Movies Management') }}
            </h2>
            <a href="{{ route('admin.movies.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add New Movie
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
                                <th class="px-4 py-3 text-left">Title</th>
                                <th class="px-4 py-3 text-left">Genre</th>
                                <th class="px-4 py-3 text-left">Director</th>
                                <th class="px-4 py-3 text-left">Duration</th>
                                <th class="px-4 py-3 text-left">Release Date</th>
                                <th class="px-4 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movies as $movie)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $movie->title }}</td>
                                <td class="px-4 py-3">{{ $movie->genre }}</td>
                                <td class="px-4 py-3">{{ $movie->director }}</td>
                                <td class="px-4 py-3">{{ $movie->duration }} min</td>
                                <td class="px-4 py-3">{{ $movie->release_date->format('M d, Y') }}</td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('admin.movies.edit', $movie) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.movies.delete', $movie) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
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
