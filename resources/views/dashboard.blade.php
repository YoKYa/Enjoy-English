<x-app-layout>
    <x-slot name="header">
        {{-- Breadcrumbs --}}
        {{ Breadcrumbs::render('topics') }}
    </x-slot>
    <livewire:topics />
</x-app-layout>