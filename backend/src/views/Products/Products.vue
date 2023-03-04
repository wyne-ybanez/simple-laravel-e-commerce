<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-lg font-normal">Products</h1>
    <button type="submit"
      class="py-2 px-6 border border-transparent text-sm font-light rounded-sm text-white bg-green-600
             hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    >
    Add Product
    </button>
  </div>
  <ProductsTable />
</template>

<script setup>
import ProductsTable from "./ProductsTable.vue";
</script>

<style scoped>
</style>
