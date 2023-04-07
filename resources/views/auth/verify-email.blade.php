<x-guest-layout>
    <div class="min-h-[50vh] mx-auto">
        <div class="flex flex-col items-center my-20 text-xl text-stone-800">
            <p class="mx-auto px-10">Thanks for signing up! Before getting started, you will need to <span class="font-bold">verify</span> your email address. We've sent you a link to assist with this.</p>
            <p class="mt-5 mx-auto px-10">If you didn't receive the email, we will gladly send you another.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="flex flex-col items-center mb-4 font-medium text-sm text-emerald-500 dark:text-emerald-500">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
        @endif

        <div class="flex items-center">
            <form method="POST" action="{{ route('verification.send') }}" class="mx-auto px-10 mb-10">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>