<template>
  <GuestLayout title="Request new password">
    <form class="mt-8 space-y-6" action="#" method="POST">
      <input type="hidden" name="remember" value="true"/>
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required=""
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:ring-zinc-500 focus:border-zinc-500 focus:z-10 sm:text-sm"
                 placeholder="Email address"/>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="text-sm">
          <router-link :to="{name: 'login'}" class="font-medium text-zinc-600 hover:text-zinc-500"> Remember your
            password?
          </router-link>
        </div>
      </div>

      <div>
        <button type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-base font-medium rounded-sm text-white bg-zinc-800 hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-700">
          Submit
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import {LockClosedIcon} from '@heroicons/vue/solid'
import GuestLayout from "../components/GuestLayout.vue";
</script>
