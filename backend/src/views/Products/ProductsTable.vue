<template>
  <div class="bg-white p-4 rounded border">
    <div class="flex justify-between pb-5">
      <div class="flex items-center">
        <!-- List options -->
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select v-model="perPage" @change="getProducts(null)"
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                 rounded-sm focus:outline-none focus:ring-zinc-500 focus:border-0 focus:z-10 cursor-pointer sm:text-sm"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <!-- Search -->
      <div>
        <input v-model="search" @change="getProducts(null)"
          class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                 rounded-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm
                 placeholder:text-slate-400"
          placeholder="Search Products">
      </div>
    </div>
    <!-- Products table -->
    <table class="table-auto w-full">
      <thead class="text-left">
        <tr>
          <TableHeaderCell @click="sortProducts('id')" class="border-b p-2 pb-5 font-medium" field="id" :sort-field="sortField" :sort-direction="sortDirection">
            ID
          </TableHeaderCell>
          <TableHeaderCell class="border-b p-2 pb-5 font-medium" field="" :sort-field="sortField" :sort-direction="sortDirection">
            Image
          </TableHeaderCell>
          <TableHeaderCell @click="sortProducts('title')" class="border-b p-2 pb-5 font-medium" field="title" :sort-field="sortField" :sort-direction="sortDirection">
            Title
          </TableHeaderCell>
          <TableHeaderCell @click="sortProducts('price')" class="border-b p-2 pb-5 font-medium" field="price" :sort-field="sortField" :sort-direction="sortDirection">
            Value
          </TableHeaderCell>
          <TableHeaderCell @click="sortProducts('updated_at')" class="border-b p-2 pb-5 font-medium" field="updated_at" :sort-field="sortField" :sort-direction="sortDirection">
            Last Updated
          </TableHeaderCell>
        </tr>
      </thead>
        <!-- Spinner -->
      <tbody v-if="products.loading">
        <tr>
          <td colspan="6">
            <Spinner v-if="products.loading" class="py-10"/>
          </td>
        </tr>
      </tbody>
      <!-- Table data -->
      <tbody v-if="!products.loading" class="font-light">
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
    <!-- Pagination -->
    <div v-if="!products.loading" class="flex justify-between items-center mt-5">
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
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import Spinner from "../../components/core/Spinner.vue"
import store from '../../store/index.js'
import PRODUCTS_PER_PAGE from '../../constants.js'
import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';

const perPage = ref(PRODUCTS_PER_PAGE)
const search = ref('')
const products = computed(() => store.state.products)
const sortField = ref('updated_at')
const sortDirection = ref('desc')

onMounted(() => {
  getProducts();
})

function getProducts(url = null) {
  store.dispatch('getProducts', {
    url,
    sort_field: sortField.value,
    sort_direction: sortDirection.value,
    search: search.value,
    perPage: perPage.value,
  })
}

function sortProducts(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field
    sortDirection.value = 'asc'
  }
  getProducts()
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
