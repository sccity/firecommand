<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Santa Clara Hub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-[#1a1512]">
        <div class="min-h-screen flex bg-[#1a1512]">
            <!-- Sidebar -->
            @auth
                @include('layouts.partials.sidebar')
            @endauth

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen bg-[#1a1512]">
                <!-- Page Content -->
                <main class="flex-1">
                    @isset($header)
                        <header class="mb-8">
                            <div class="flex items-center justify-between bg-[#2b2320] rounded-xl shadow-sm border border-[#3d322d] px-6 py-4">
                                <h1 class="text-2xl font-bold text-gray-100">
                                    {{ $header }}
                                </h1>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-400">{{ now()->format('l, F j, Y') }}</span>
                                </div>
                            </div>
                        </header>
                    @endisset

                    <div class="mx-auto max-w-[2000px] w-full">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Footer -->
                <footer class="bg-[#2b2320] border-t border-[#3d322d] shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-8">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                &copy; {{ date('Y') }} City of Santa Clara, Utah
                            </div>
                            <div class="text-sm text-gray-400">
                                All rights reserved
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
