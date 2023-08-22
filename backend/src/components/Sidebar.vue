<template>
  <div class="w-[200px] transition-all bg-black text-zinc-400 font-sans py-4 px-2 md:hidden block">
    <div class="mt-4 mb-6 pb-5 border-b-[1px]">
      <router-link :to="{name: 'app.dashboard'}" class="mx-auto">
          <span class="px-2">{{ businessName }}</span>
          <span class="rounded-full px-1 uppercase text-xs text-black font-base mb-4" 
                :class="{ 'bg-red-600' : demo, 'bg-green-600' : live, 'bg-purple-600' : staging }">
              {{ status }}
          </span>
      </router-link>
    </div>
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white">
      <span class="text-md">
        Dashboard
      </span>
    </router-link>
    <router-link :to="{name: 'app.products'}"
                 class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white">
      <span class="text-md">
        Products
      </span>
    </router-link>
    <router-link :to="{name: 'app.orders'}"
                 class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white">
      <span class="text-md">
        Orders
      </span>
    </router-link>
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white">
      <span class="text-md">
        Users
      </span>
    </router-link>
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white">
      <span class="text-md">
        Reports
      </span>
    </router-link>
  </div>
</template>

<script setup>
import {ref, computed} from "vue";

const businessName = ref("Digi.Art");

// Status changes
const demo = ref(true);
const live = ref(false);
const staging = ref(false);

const status = computed(() => {
  if (demo.value) {
    return "demo"
  }
  if (live.value) {
    return "live"
  }
  if (staging.value) {
    return "staging"
  }
});

</script>

<style scoped>

</style>
