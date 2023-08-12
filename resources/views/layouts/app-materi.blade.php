<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> @stack('pageTitle') {{ config('app.name', 'Laravel') }}</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('/logo/logo_enjoy_eng.png') }}">
    {{-- Script --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    {{-- Style --}}
    @livewireStyles
</head>

<body>
    <div class="flex w-full h-screen">
        <div class="w-full bg-white">
            <div class="fixed w-full z-10">
                <div class="bg-white w-full flex justify-center flex-col items-center">
                    <div class="flex justify-start items-center text-xl w-10/12 mt-2">
                        @if (isset($header))
                        {{ $header }}
                        @endif
                    </div>
                    <hr class="h-1 rounded-full bg-blue-300 w-10/12 mt-1">
                </div>
            </div>
            {{-- Content --}}
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>
    @stack('modals')
    @stack('scripts')
    @livewireScripts
</body>

</html>