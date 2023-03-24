<x-app-layout>
    <form method="POST" action="{{ route('login') }}" class="w-[400px] mx-auto p-6 my-16">
        <h2 class="text-2xl font-semibold text-center mb-5">
            Login to your account
        </h2>
        <p class="text-center text-gray-500 mb-6">
            or
            <a href="{{ route('register') }}" class="text-sm text-primary hover:text-black">
                create new account
            </a>
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:ring-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full focus:ring-0" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-0" name="remember">
                <span class="ml-2 text-sm text-black dark:text-black">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-black dark:text-black hover:text-primary dark:hover:text-primary rounded-md focus:outline-none focus:ring-0" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ml-3 focus:ring-0">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>