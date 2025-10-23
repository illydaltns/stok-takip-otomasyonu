<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Dark mode initialization
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                console.log('Initial dark mode applied');
            } else {
                document.documentElement.classList.remove('dark');
                console.log('Initial light mode applied');
            }
        });
    </script>
</head>
<body class="font-sans antialiased bg-[#F9FAFB] dark:bg-dark-bg-primary text-gray-800 dark:text-dark-text-primary min-h-screen">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @auth
            @include('layouts.sidebar')
        @endauth

        <!-- Main Content -->
        <div class="flex-1 flex flex-col @auth ml-60 @endauth min-h-screen">
            <!-- Top Navigation -->
            @auth
                @include('layouts.navigation')
            @endauth

            <!-- Page Header -->
            @isset($header)
                <header class="bg-white dark:bg-dark-bg-secondary shadow-sm border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto py-4 px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-[#F9FAFB] dark:bg-dark-bg-primary">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
