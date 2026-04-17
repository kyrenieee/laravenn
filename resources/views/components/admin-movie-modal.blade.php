@props(['movie' => null, 'halls' => null])

<x-modal name="movie-form-modal" :show="false" maxWidth="2xl">
    <div x-data="{}">
        <div class="p-6 bg-gradient-to-br from-white/50 to-purple-50/30 dark:from-slate-800/50 dark:to-purple-900/20 supports-backdrop-filter:backdrop-blur-sm border-b border-white/20 dark:border-white/10">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-400 dark:to-indigo-400 bg-clip-text text-transparent">{{ is_null($movie) ? 'Add New Movie' : 'Edit Movie' }}</h2>
                <button @click="$dispatch('close-modal', 'movie-form-modal')" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Progress Steps -->
                <div class="mt-4 flex justify-between items-center">
                <div class="flex-1 flex items-center">
                    <div class="step-indicator w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 text-white flex items-center justify-center font-bold text-sm" data-step="1">1</div>
                    <div class="flex-1 h-1 bg-gradient-to-r from-purple-300 to-purple-100 dark:from-purple-700 dark:to-purple-900 mx-2" id="step-line-1"></div>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-700 text-gray-600 dark:text-gray-400 flex items-center justify-center font-bold text-sm" data-step="2">2</div>
                    <div class="flex-1 h-1 bg-gray-200 dark:bg-slate-700 mx-2" id="step-line-2"></div>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-700 text-gray-600 dark:text-gray-400 flex items-center justify-center font-bold text-sm" data-step="3">3</div>
                </div>
            </div>
            <div class="mt-2 flex justify-between text-xs font-medium text-gray-600 dark:text-gray-400">
                <span>Basic Info</span>
                <span>Details</span>
                <span>Review</span>
            </div>
        </div>

        <form @submit.prevent="submitForm" x-data="movieForm({{ is_null($movie) ? 'null' : $movie->id }})" class="p-6">
            @csrf

            <!-- Step 1: Basic Info (Title, Genre, Director) -->
            <div x-show="step === 1" x-transition class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h3>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Movie Title</label>
                    <input type="text" id="title" x-model="formData.title" placeholder="Enter movie title" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">The official title of the movie</p>
                </div>

                <!-- Genre -->
                <div>
                    <label for="genre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Genre</label>
                    <input type="text" id="genre" x-model="formData.genre" placeholder="e.g., Action, Drama, Comedy" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Main genre classification</p>
                </div>

                <!-- Director -->
                <div>
                    <label for="director" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Director</label>
                    <input type="text" id="director" x-model="formData.director" placeholder="Enter director name" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Director's name</p>
                </div>
            </div>

            <!-- Step 2: Details (Duration, Release Date, Hall, Description) -->
            <div x-show="step === 2" x-transition class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Movie Details</h3>

                <!-- Duration -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="duration" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Duration (minutes)</label>
                        <input type="number" id="duration" x-model="formData.duration" placeholder="120" min="1" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Total movie length</p>
                    </div>

                    <!-- Release Date -->
                    <div>
                        <label for="release_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Release Date</label>
                        <input type="date" id="release_date" x-model="formData.release_date" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Official release date</p>
                    </div>
                </div>

                <!-- Hall Selection -->
                <div>
                    <label for="hall_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Hall</label>
                    <select id="hall_id" x-model="formData.hall_id" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                        <option value="">Select a hall</option>
                        @foreach($halls as $hall) {{-- Assuming $halls is passed from AdminDashboardController and contains hall_number --}}
                            <option value="{{ $hall->id }}">Hall {{ $hall->hall_number }} ({{ $hall->total_seats }} seats)</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Which hall will this movie be screened in</p>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="description" x-model="formData.description" rows="4" placeholder="Enter a detailed description of the movie" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors resize-none"></textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Brief or detailed synopsis</p>
                </div>
            </div>

            <!-- Step 3: Media & Review -->
            <div x-show="step === 3" x-transition class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Media & Review</h3>

                <!-- Image URL -->
                <div>
                    <label for="image_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Poster Image URL</label>
                    <input type="url" id="image_url" x-model="formData.image_url" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2.5 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg supports-backdrop-filter:backdrop-blur-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:text-white transition-colors">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Full URL to movie poster image</p>
                </div>

                <!-- Image Preview -->
                <template x-if="formData.image_url">
                    <div class="mt-4 text-center">
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Image Preview</p>
                        <div class="bg-gradient-to-br from-white/50 to-purple-50/30 dark:from-slate-800/50 dark:to-purple-900/20 supports-backdrop-filter:backdrop-blur-sm rounded-lg p-3 border border-white/20 dark:border-white/10">
                            <img :src="formData.image_url" alt="Movie poster preview" class="w-full max-w-xs h-64 object-contain rounded-lg mx-auto shadow-lg" onerror="this.style.display='none'">
                        </div>
                    </div>
                </template>

                <!-- Review -->
                <div class="bg-gradient-to-br from-white/50 to-purple-50/30 dark:from-slate-800/50 dark:to-purple-900/20 supports-backdrop-filter:backdrop-blur-sm p-6 rounded-lg border border-white/20 dark:border-white/10 mt-6">
                    <h4 class="text-sm font-bold bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-400 dark:to-indigo-400 bg-clip-text text-transparent mb-4">Review Summary</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between py-2.5 border-b border-white/10 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Title:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="formData.title || '-'"></span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-white/10 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Genre:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="formData.genre || '-'"></span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-white/10 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Director:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="formData.director || '-'"></span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-white/10 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Duration:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="formData.duration ? formData.duration + ' min' : '-'"></span>
                        </div>
                        <div class="flex justify-between py-2.5 border-b border-white/10 dark:border-white/5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Release Date:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="formData.release_date || '-'"></span>
                        </div>
                        <div class="flex justify-between py-2.5">
                            <span class="text-gray-600 dark:text-gray-400 font-medium">Hall:</span>
                            <span class="font-semibold text-gray-900 dark:text-white" x-text="getHallNumber(formData.hall_id) || '-'"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between pt-6 border-t border-white/10 dark:border-white/5 mt-6 gap-3">
                <button type="button" @click="previousStep()" :disabled="step === 1"
                    class="px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/50 dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700/70 disabled:opacity-50 disabled:cursor-not-allowed transition-all supports-backdrop-filter:backdrop-blur-sm">
                    ← Back
                </button>

                <button type="button" @click="nextStep()" :disabled="step === 3" x-show="step < 3"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-lg shadow-purple-500/30">
                    Next →
                </button>

                <button type="submit" x-show="step === 3"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all shadow-lg shadow-green-500/30">
                    {{ is_null($movie) ? 'Add Movie' : 'Update Movie' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function movieForm(movieId) {
            return {
                step: 1,
                formData: {
                    title: '{{ $movie?->title ?? '' }}',
                    description: '{{ $movie?->description ?? '' }}',
                    genre: '{{ $movie?->genre ?? '' }}',
                    director: '{{ $movie?->director ?? '' }}',
                    duration: '{{ $movie?->duration ?? '' }}',
                    release_date: '{{ $movie?->release_date?->format("Y-m-d") ?? '' }}',
                    image_url: '{{ $movie?->image_url ?? '' }}',
                    hall_id: '{{ $movie?->hall_id ?? '' }}',
                },

                nextStep() {
                    if (this.step === 1) {
                        if (!this.formData.title || !this.formData.genre || !this.formData.director) {
                            alert('Please fill in all basic information fields');
                            return;
                        }
                    }
                    if (this.step === 2) {
                        if (!this.formData.duration || !this.formData.release_date || !this.formData.description || !this.formData.hall_id) {
                            alert('Please fill in all detail fields including hall selection');
                            return;
                        }
                    }
                    if (this.step < 3) this.step++;
                },

                previousStep() {
                    if (this.step > 1) this.step--;
                },

                getHallNumber(hallId) {
                    const halls = {!! json_encode($halls->mapWithKeys(fn($h) => [$h->id => $h->hall_number])->toArray()) !!};
                    return halls[hallId] || null;
                },

                submitForm() {
                    const url = movieId
                        ? `/admin/movies/${movieId}`
                        : '/admin/movies';
                    const method = movieId ? 'PUT' : 'POST';

                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(movieId ? 'Movie updated successfully!' : 'Movie added successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + (data.message || 'Failed to save movie'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error saving movie');
                    });
                }
            }
        }
    </script>
</x-modal>
