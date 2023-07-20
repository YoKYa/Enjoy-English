@props(['active'])

@php
$classes = ($active ?? false)
? 'text-white mt-4 text-xl flex items-center p-2 bg-biru-2 rounded-lg'
: 'text-white mt-4 text-xl flex items-center p-2';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>