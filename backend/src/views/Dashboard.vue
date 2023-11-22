<template>
    <h1 class="text-lg font-normal mb-3">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <!-- Acive Customers -->
      <div class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center">
        <label class="font-light">Active Customers</label>
        <span class="text-2xl pt-2">15</span>
      </div>
      <!-- End Active Customers -->
      <!-- Acive Products -->
      <div class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center">
        <label class="font-light">Active Products</label>
        <span class="text-2xl pt-2">28</span>
      </div>
      <!-- End Active Products -->
      <!-- Paid Orders -->
      <div class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center">
        <label class="font-light">Paid Orders</label>
        <span class="text-2xl pt-2">103</span>
      </div>
      <!-- End Paid Orders -->
      <!-- Total Income -->
      <div class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center">
        <label class="font-light">Total Income</label>
        <span class="text-2xl pt-2">€253,212</span>
      </div>
      <!-- End Total Income -->
    </div>
</template>

<script>
export default {
  name: "Dashboard"
}
</script>

<style scoped>

</style>
