<x-guest-layout>
    <div class="min-h-[50vh]">
        <div class="flex flex-col items-center my-20 text-xl text-stone-800">
            <p class="mx-auto">Thanks for signing up! Before getting started, you will need to <span class="font-bold">verify</span> your email address. We've sent you a link to assist with this.</p>
            <p class="mt-5 self-start ml-[28%]">If you didn't receive the email, we will gladly send you another.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}" class="ml-[28%] mb-10">
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