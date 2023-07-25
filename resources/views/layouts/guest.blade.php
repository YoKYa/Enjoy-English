<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@stack('pageTitle') {{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_enjoy_eng.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex w-full">
        <div class="flex flex-col items-center justify-center w-1/2 h-full min-h-screen text-white bg-biru-2">
            <x-application-logo />
        </div>
        <div class="w-1/2 antialiased">
            {{ $slot }}
        </div>
    </div>
</body>

</html>