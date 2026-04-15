<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Cinema World</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">
    <div class="text-center text-white">

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                Register
            </a>
        </div>
    </div>
</body>
</html>
