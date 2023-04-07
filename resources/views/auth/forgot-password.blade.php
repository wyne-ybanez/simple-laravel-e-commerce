<x-app-layout>
    <h2 class="text-2xl font-semibold text-center mb-2 mt-32">
        Reset your password
    </h2>
    <p class="text-center text-gray-500">
        or
        <a href="{{ route('login') }}" class="text-sm text-primary hover:text-black">
            login to your account
        </a>
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="flex justify-center align-center my-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="w-[450px] mx-auto p-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mb-4 mt-20 text-base text-gray-900 dark:text-stone-900 w-[450px] mx-auto">
        <p>Forgot your password? No problem.</p>
        <br>
        <p>Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>
</x-app-layout>