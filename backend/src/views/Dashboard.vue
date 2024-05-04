<template>
    <h1 class="text-lg font-normal mb-3">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-3">
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 my-3">
      <div class="bg-white py-6 lg:col-span-2 px-5 rounded border text-lg flex flex-col items-center justify-center">
        Products
      </div>
      <div class="md:grid grid-cols-1">
        <div class="bg-white py-6 md:row-span-2 lg:h-[20vw] rounded border text-lg flex flex-col items-center justify-center">
          <DoughnutChart :data="chartData"/>
        </div>
        <div class="bg-white py-6 md:row-span-5 px-5 rounded border text-lg flex flex-col items-center justify-center mt-3">
          Customers
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
      </div>
    </div>
</template>

<script setup>
  import DoughnutChart from '../components/core/Charts/Doughnut.vue'

  const chartData = {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [
      {
        data: [300, 50, 100],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
      }
    ]
  };
</script>

<style scoped>

</style>
