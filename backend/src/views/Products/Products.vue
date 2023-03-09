<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-lg font-normal">Products</h1>
    <button type="submit"
      @click="showProductModal"
      class="py-2 px-6 border border-transparent text-sm font-light rounded-sm text-white bg-green-600
             hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    >
    Add Product
    </button>
  </div>
  <pre>{{ showModal }}</pre>
  <ProductModal v-model="showModal" :product="productModel"/>
  <ProductsTable />
</template>

<script setup>
import ProductModal from "./ProductModal.vue";
import ProductsTable from "./ProductsTable.vue";
import {ref} from 'vue';

const DEFAULT_PRODUCT = {
  id: '',
  title: '',
  description: '',
  image: '',
  price: ''
}

const productModel = ref({...DEFAULT_PRODUCT})
const showModal = ref(false);

function showProductModal() {
  showModal.value = true;
}
</script>

<style scoped>
</style>
