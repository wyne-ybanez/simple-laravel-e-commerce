<template>
    <GuestLayout title="Set new password">
        <form class="mt-8 space-y-6" action="#" method="POST">
            <input type="hidden" name="remember" value="true" />
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="new-password" class="sr-only"
                        >New Password</label
                    >
                    <input
                        id="new-password"
                        name="password"
                        type="password"
                        required=""
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 focus:z-10 sm:text-sm"
                        placeholder="New Password"
                    />
                </div>
                <div>
                    <label for="password-repeat" class="sr-only"
                        >Repeat Password</label
                    >
                    <input
                        id="password-repeat"
                        name="password_repeat"
                        type="password"
                        required=""
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 focus:z-10 sm:text-sm"
                        placeholder="Repeat Password"
                    />
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <router-link
                        :to="{ name: 'login' }"
                        class="font-medium text-zinc-600 hover:text-zinc-500"
                    >
                        Go back to Login
                    </router-link>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-zinc-600 hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500"
                >
                    <span
                        class="absolute left-0 inset-y-0 flex items-center pl-3"
                    >
                        <LockClosedIcon
                            class="h-5 w-5 text-zinc-500 group-hover:text-zinc-400"
                            aria-hidden="true"
                        />
                    </span>
                    Submit
                </button>
            </div>
        </form>
    </GuestLayout>
</template>

<script>
import { LockClosedIcon } from "@heroicons/vue/solid";
import GuestLayout from "../components/GuestLayout.vue";

export default {
    components: {
        LockClosedIcon,
        GuestLayout,
    },
};
</script>
