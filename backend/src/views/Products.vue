<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-lg font-normal">Products</h1>
    <button type="submit"
      class="py-1 px-16 border border-transparent text-sm font-light rounded-sm text-white bg-green-600
             hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700"
    >
    Add Product
    </button>
  </div>
  <!-- Paginate options -->
  <div class="bg-white p-4 rounded border">
    <div class="flex justify-between pb-5">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select v-model="perPage" @change="getProducts(null)" 
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                 rounded-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <div>
        <input v-model="search" @change="getProducts(null)"
          class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                 rounded-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
          placeholder="Type to Search products">
      </div>
    </div>
    <!-- Spinner -->
    <Spinner v-if="products.loading"
      class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"
    />
    <!-- Products Table -->
    <template v-else>
      <table class="table-auto w-full">
        <thead class="text-left">
          <tr>
            <th class="border-b p-2 font-medium">ID</th>
            <th class="border-b p-2 font-medium">Image</th>
            <th class="border-b p-2 font-medium">Title</th>
            <th class="border-b p-2 font-medium">Value</th>
            <th class="border-b p-2 font-medium">Last Updated</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product of products.data">
            <td class="border-b p-2">{{ product.id }}</td>
            <td class="border-b p-2">
              <img class="w-16 h-16 object-cover" :src="product.image" :alt="product.title">
            </td>
            <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
              {{ product.title }}
            </td>
            <td class="border-b p-2">
              {{ product.price }}
            </td>
            <td class="border-b p-2 ">
              {{ product.updated_at }}
            </td>
          </tr>
        </tbody>
      </table>
      <!-- // Pagination (Network XHR: 'meta' values) -->
      <div class="flex justify-between items-center mt-5">
        <span>
          Showing from {{ products.from }} to {{ products.to }}
        </span>
        <nav
          v-if="products.total > products.limit"
          class="relative z-0 inline-flex justify-center rounded-sm shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <a
            v-for="(link, i) of products.links"
            :key="i"
            :disabled="!link.url"
            href="#"
            @click.prevent="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-base whitespace-nowrap"
            :class="[
              link.active
                ? 'z-10 bg-gray-50 border-gray-400 text-gray-500'
                : 'bg-white border-gray-200 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-sm' : '',
              i === products.links.length - 1 ? 'rounded-r-sm' : '',
              !link.url ? 'hidden hover:bg-gray-50 text-gray-500': ''
              ]"
            v-html="link.label"
          >
          </a>
        </nav>
      </div>
    </template>

  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import Spinner from "../components/core/Spinner.vue"
import store from '../store/index.js';
import PRODUCTS_PER_PAGE from '../constants.js'

const perPage = ref(PRODUCTS_PER_PAGE)
const search = ref('')
const products = computed(() => store.state.products)

onMounted(() => {
  getProducts();
})

function getProducts(url = null) {
  store.dispatch('getProducts', {
    url,
    search: search.value,
    perPage: perPage.value,
  })
}

function getForPage(e, link) {
  if (!link.url || link.active) {
    return
  }
  getProducts(link.url)
}
</script>

<style scoped>

</style>
