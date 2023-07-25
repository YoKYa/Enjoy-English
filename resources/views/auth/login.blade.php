<x-guest-layout>
    @push('pageTitle', 'Login - ')
    <x-authentication-card>
        <x-slot name="title" class="block">
            <a href="/login" class="flex justify-center w-full text-2xl text-center text-gray-500">
                LOGIN
            </a>
            <hr>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 text-sm font-medium ">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="email" value="{{ __('EMAIL') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" placeholder="herman@gmail.com" />
            </div>
            <div class="mt-4">
                <x-label for="password" value="{{ __('PASSWORD') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" placeholder="password" />
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>
            <hr class="block mt-4">

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="text-sm underline rounded-md focus:outline-0 text-biru-3 hover:text-biru-2 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <x-button class="ml-4 bg-biru-1 text-putih-1 hover:bg-biru-2">
                    {{ __('Log in') }}
                </x-button>
            </div>
            <hr class="block w-full mt-4">
            <div class="flex justify-center mt-4">
                <div class="mr-2 text-sm">Don't have an account?</div>
                <a class="text-sm underline rounded-md text-biru-3 hover:text-biru-2 focus:outline-none focus:ring-2 focus:ring-offset-2 "
                    href="{{ route('register') }}">
                    {{ __(' Create An Account?') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>