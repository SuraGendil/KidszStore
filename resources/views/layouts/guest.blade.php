<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Masuk - {{ config('app.name', 'KIDSZSTORE') }}</title>

        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#1A255B]">
            <div class="mb-4">
                <a href="/" aria-label="KIDSZSTORE Beranda">
                    <img src="{{ asset('images/logo-KidszStore.png') }}" alt="Kidszstore Logo" class="w-20 h-20 object-contain rounded-full shadow-lg" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-[#0e1a4b]/80 backdrop-blur-sm border border-blue-400/20 shadow-2xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
