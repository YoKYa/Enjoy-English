<div>
    {{-- Breadcrumbs --}}
    {{ Breadcrumbs::render('admin') }}
    {{-- Content --}}
    <div class="mb-4 border-2 border-gray-500 shadow rounded-lg h-auto p-8 grid grid-cols-5 gap-4">
        <x-topic href="{{ route('admin.users') }}">
            <div class="w-24 h-24"><img src="{{ asset('svg/users.svg') }}" alt="Classmates"></div>
            <div>USERS</div>
        </x-topic>
    </div>
    {{ Breadcrumbs::render('admin.topics') }}
    <livewire:topics />
</div>