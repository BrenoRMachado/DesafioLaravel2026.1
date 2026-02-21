<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-COMMERCE') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background-color: #1a0a20;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48 h-auto drop-shadow-2xl">
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 overflow-hidden sm:rounded-2xl" 
                 style="background-color: rgba(45, 15, 55, 0.9); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>