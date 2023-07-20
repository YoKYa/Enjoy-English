<x-nav-link href="{{ route('admin') }}" :active="request()->routeIs('admin')">
    <img class="h-12 w-12" src="{{ asset('svg/admin.svg') }}">
    <div class="ml-4">ADMIN</div>
</x-nav-link>