<template>
  <GuestLayout title="Sign into your account">
    <form class="mt-8 space-y-6" method="POST" @submit.prevent="login">
      <div v-if="errorMsg" class="flex items-center justify-between py-3 px-5 bg-red-500 text-white rounded">
        {{ errorMsg }}
        <span
          @click="errorMsg = ''"
          class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
        >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </span>
      </div>
      <input type="hidden" name="remember" value="true"/>
      <div class="rounded-sm shadow-sm space-y-8">
        <div class="pt-2">
          <h3 class="text-zinc-500 pb-2">Email</h3>
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required="" v-model="user.email"
                 class="appearance-none rounded-none relative block w-full px-3 py-3 border border-zinc-300 placeholder-zinc-400 bg-black text-white focus:ring-zinc-500 focus:border-white sm:text-sm"
                 placeholder="Email address"/>
        </div>
        <div class="pb-2">
          <h3 class="text-zinc-500 pb-2">Password</h3>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required=""
                 v-model="user.password"
                 class="appearance-none rounded-none relative block w-full px-3 py-3 border border-zinc-300 placeholder-zinc-400 bg-black text-white focus:ring-zinc-500 focus:border-white sm:text-sm"
                 placeholder="Password"/>
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" v-model="user.remember"
                 class="h-4 w-4 text-green-400 focus:ring-green-500 border-green-300 rounded cursor-pointer"/>
          <label for="remember-me" class="ml-2 block text-base text-gray-500"> Remember me </label>
        </div>

        <div class="text-base">
          <router-link :to="{name: 'requestPassword'}" class="font-medium text-gray-500 hover:text-white"> Forgot
            your password?
          </router-link>
        </div>
      </div>

      <div>
        <button type="submit"
                :disabled="loading"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-base font-medium rounded-sm text-white bg-zinc-800 hover:bg-white hover:text-black transition duration-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500"
                :class="{
                  'cursor-not-allowed': loading,
                  'hover:bg-white': loading,
                }">
          <svg
            v-if="loading"
            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            ></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-zinc-500 group-hover:text-zinc-400" aria-hidden="true"/>
            </span>
          Sign in
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import {ref} from 'vue'
import {LockClosedIcon} from '@heroicons/vue/solid'
import GuestLayout from "../components/GuestLayout.vue";
import store from "../store";
import router from "../router";

let loading = ref(false);
let errorMsg = ref("");

const user = {
  email: '',
  password: '',
  remember: false
}

function login() {
  loading.value = true;
  store.dispatch('login', user)
    .then(() => {
      loading.value = false;
      router.push({name: 'app.dashboard'})
    })
    .catch(({response}) => {
      loading.value = false;
      errorMsg.value = response.data.message;
    })
}

</script>
