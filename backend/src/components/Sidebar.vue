<template>
  <div class="w-[200px] transition-all bg-black text-zinc-400 font-sans py-4 px-2 md:hidden block">
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

</script>

<style scoped>

</style>
