<div>
    <x-slot name="header">
        {{-- Breadcrumbs --}}
        @if (Route::current()->getName() != 'admin')
        @push('pageTitle', 'Topics - ')
        {{ Breadcrumbs::render('topics') }}
        @endif
    </x-slot>
    <div class="border-2 border-gray-500 shadow rounded-lg h-auto p-8 grid grid-cols-5 gap-4">
        @foreach ($topics as $topic)
        @if (Route::current()->getName() == 'admin')
        <x-topic href="{{ route('admin.materi', $topic->id) }}">
            <div class="w-24 h-24"><img src="{{ asset($topic->svg) }}" alt="{{ $topic->name }}"></div>
            <div>{{ $topic->name }}</div>
        </x-topic>
        @else
        <x-topic href="{{ route('materi', $topic->id) }}">
            <div class="w-24 h-24"><img src="{{ asset($topic->svg) }}" alt="{{ $topic->name }}"></div>
            <div>{{ $topic->name }}</div>
        </x-topic>
        @endif
        @endforeach
    </div>
</div>