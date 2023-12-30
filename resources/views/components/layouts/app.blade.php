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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            // Check if a theme preference is stored in localStorage
            const savedTheme = localStorage.getItem('theme');
          
            // If a theme preference exists, set it
            if (savedTheme) {
                document.documentElement.classList.add(savedTheme);
            }
          
            // Toggle theme function
            function toggleTheme() {
                // Toggle the 'dark' class on the html tag
                document.documentElement.classList.toggle('dark');
          
                // Check if the 'dark' class is present
                const isDarkMode = document.documentElement.classList.contains('dark');
          
                // Set the theme preference in localStorage
                localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
          
            }
          
            // Attach the toggleTheme function to a button click or any other event you prefer
            document.getElementById('theme-toggle-button').addEventListener('click', toggleTheme);
            });
          </script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
