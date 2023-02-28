<template>
  <div class="w-[200px] transition-all bg-black text-white py-4 px-2">
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center p-2 mb-4 rounded transition-colors hover:bg-zinc-800">
      <span class="mr-2 text-gray-300">
        <HomeIcon class="w-5"/>
      </span>
      <span class="text-base">
        Dashboard
      </span>
    </router-link>
    <router-link :to="{name: 'app.products'}"
                 class="flex items-center p-2 mb-4 rounded transition-colors hover:bg-zinc-800">
      <span class="mr-2 text-gray-300">
        <ViewListIcon class="w-5"/>
      </span>
      <span class="text-base">
        Products
      </span>
    </router-link>
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center p-2 mb-4 rounded transition-colors hover:bg-zinc-800">
      <span class="mr-2 text-gray-300">
        <UsersIcon class="w-5"/>
      </span>
      <span class="text-base">
        Users
      </span>
    </router-link>
    <router-link :to="{name: 'app.dashboard'}"
                 class="flex items-center p-2 mb-4 rounded transition-colors hover:bg-zinc-800">
      <span class="mr-2 text-gray-300">
        <ChartBarIcon class="w-5"/>
      </span>
      <span class="text-base">
        Reports
      </span>
    </router-link>
  </div>
</template>

<script setup>
  import {HomeIcon, UsersIcon, ViewListIcon, ChartBarIcon} from '@heroicons/vue/outline'
</script>

<style scoped>

</style>
