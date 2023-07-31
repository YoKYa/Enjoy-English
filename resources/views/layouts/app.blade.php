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
	<div class="flex w-full h-screen fixed">
		@livewire('navigation-menu')

		<div class="w-3/4 bg-white p-8 overflow-y-auto">
			<x-banner />

			@if (isset($header))
			{{ $header }}
			@endif
			{{-- Content --}}
			<main>
				{{ $slot }}
			</main>
		</div>
	</div>
	@stack('modals')

	@livewireScripts
</body>

</html>