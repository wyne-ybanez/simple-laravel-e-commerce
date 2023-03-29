<x-app-layout>
    <form method="POST" action="{{ route('login') }}" class="w-[450px] mx-auto p-6 my-36">
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
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="appearance-none rounded-none relative block w-full px-3 py-3 border border-zinc-300 placeholder-zinc-400 bg-black text-white focus:ring-zinc-500 dark:focus:ring-zinc-500 focus:border-white sm:text-sm" type="email" name="email" :value="old('email')" :errors="$errors" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="appearance-none rounded-none relative block w-full px-3 py-3 border border-zinc-300 placeholder-zinc-400 bg-black text-white focus:ring-zinc-500 dark:focus:ring-zinc-500 focus:border-white sm:text-sm" type="password" name="password" :value="old('password')" required autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-end mt-10">
            <x-primary-button class="focus:ring-0 w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 flex justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-0" name="remember">
                <span class="ml-2 text-sm text-black dark:text-black">{{ __('Remember me') }}</span>
            </label>
            <!-- Forgot password -->
            @if (Route::has('password.request'))
                <a class="underline text-sm text-black dark:text-black hover:text-primary dark:hover:text-primary rounded-md focus:outline-none focus:ring-0" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</x-app-layout>