<nav class="bg-gray-950 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="text-red-500 font-extrabold text-2xl tracking-widest uppercase">
            NETFLEX
        </a>

        {{-- Nav Links --}}
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-300">
            <li>
                <a href="/" class="hover:text-white transition-colors duration-200">Home</a>
            </li>
            <li>
                <a href="/dashboard" class="hover:text-white transition-colors duration-200">Dashboard</a>
            </li>
            <li>
                <a href="#" class="hover:text-white transition-colors duration-200">Movies</a>
            </li>
            <li>
                <a href="#" class="hover:text-white transition-colors duration-200">Cinemas</a>
            </li>
            <li>
                <a href="#" class="hover:text-white transition-colors duration-200">Showtimes</a>
            </li>
        </ul>

        {{-- Auth --}}
        <div class="flex items-center gap-3">
            <a href="#"
               class="text-sm font-semibold text-gray-300 hover:text-white border border-gray-600 hover:border-white px-4 py-1.5 rounded-full transition-all duration-200">
                Sign In
            </a>
            <a href="#"
               class="text-sm font-semibold text-white bg-red-600 hover:bg-red-700 px-4 py-1.5 rounded-full transition-all duration-200">
                Sign Up
            </a>
        </div>

    </div>
</nav>
