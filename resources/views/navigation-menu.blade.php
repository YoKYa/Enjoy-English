<div class="w-1/4 bg-biru-3 p-8 flex flex-col">
    <div class="w-full flex justify-center">
        <a href="{{ route('topics') }}" class="h-40 w-40">
            <x-application-logo />
        </a>
    </div>
    <x-hr />
    <div class="text-lg text-white mt-4 p-2">Hello {{ Auth::user()->name }}</div>
    <x-nav-link href="{{ route('topics') }}" :active="request()->routeIs('topics')">
        <img class="h-12 w-12" src="{{ asset('svg/browser.svg') }}">
        <div class="ml-4">TOPICS</div>
    </x-nav-link>
    <x-hr />
    <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
        <img class="h-12 w-12" src="{{ asset('svg/idcard.svg') }}">
        <div class="ml-4">PROFILE</div>
    </x-nav-link>
    @if (Auth::user()->roles == 'admin' || Auth::user()->roles == 'superadmin' )
    <x-nav-admin />
    @endif

    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf
        <div class="text-white mt-4 text-xl flex items-center p-2">
            <img class="h-12 w-12" src="{{ asset('svg/key.svg') }}" alt="">
            <a href="{{ route('logout') }}" class="ml-4" @click.prevent="$root.submit();">LOGOUT</a>
        </div>
    </form>
</div>