<template>
  <div class="min-h-full bg-gray-200 flex">
    <!--    Sidebar-->
    <Sidebar />
    <!--/    Sidebar-->

    <div class="flex-1">
      <Navbar></Navbar>
      <!--      Content-->
      <main class="p-6 ">
        <router-view></router-view>
      </main>
      <!--      Content-->
    </div>
  </div>
  <Toast />
</template>

<script setup>
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue"

const {title} = defineProps({
  title: String
})
</script>

<style scoped>
</style>
