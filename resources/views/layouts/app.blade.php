<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Tugas') — {{ config('app.name', 'Laravel') }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('tasks.index') }}" class="text-lg font-bold text-indigo-600 dark:text-indigo-400">📋 TaskManager</a>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">+ Tambah Tugas</a>
        </div>
    </nav>

    {{-- Flash --}}
    @if(session('success'))
        <div class="max-w-4xl mx-auto px-4 mt-4">
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg text-sm">
                ✅ {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Content --}}
    <main class="max-w-4xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-sm text-gray-400 py-6">
        &copy; {{ date('Y') }} TaskManager — Vino Hafizh - XI RPL / 41
    </footer>
</body>
</html>
