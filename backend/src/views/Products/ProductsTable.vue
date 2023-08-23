<template>
  <div class="bg-white p-4 rounded border animate-fade-in">
    <div class="flex justify-between pb-5">
      <div class="flex items-center">
        <!-- List options -->
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select v-model="perPage" @change="getProducts(null)"
          class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 bg-gray-50 text-gray-900
                 rounded-sm focus:outline-none focus:ring-zinc-500 focus:border-0 focus:z-10 cursor-pointer sm:text-sm"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span class="ml-3"> {{ products.total }} Products</span>
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
          <TableHeaderCell @click="sortProducts('category')" class="border-b p-2 pb-5 font-medium" field="category" :sort-field="sortField" :sort-direction="sortDirection">
            Category
          </TableHeaderCell>
          <TableHeaderCell class="border-b p-2 pb-5 font-medium" field="color">
            Color
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
            <Spinner v-if="products.loading" class="py-10 h-[65.1vh] justify-center align-center"/>
          </td>
        </tr>
      </tbody>
      <!-- Table data -->
      <tbody v-if="!products.loading" class="font-light">
        <!-- Add animation style if needed :style="{'animation-delay': `${index * 0.05}s`}" -->
        <tr v-for="(product, index) of products.data" class="animate-fade-in">
          <td class="border-b p-2">{{ product.id }}</td>
          <td class="border-b p-2">
            <img class="w-16 h-16 object-cover" :src="product.image_url" :alt="product.title">
          </td>
          <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
            {{ product.title }}
          </td>
          <td class="border-b p-2">
            {{ product.price }}
          </td>
          <td class="border-b p-2">
            {{ product.category }}
          </td>
          <td class="border-b p-2">
            <div class="text-black py-1 px-2 rounded w-fit" :class="{
                'bg-emerald-400': ['true', '1', 1, true].includes(product.color),
                'bg-gray-300': ['false', '0', 0, false].includes(product.color),
              }"
            >
              <span class="py-1" v-if="product.color">
                  Colored
              </span>
              <span class="py-1" v-else>
                  Grayscale
              </span>
            </div>
          </td>
          <td class="border-b p-2 ">
            {{ product.updated_at }}
          </td>
          <td class="border-y p-2 ">
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="inline-flex items-center justify-center w-full rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                >
                  <DotsVerticalIcon
                    class="h-5 w-5 text-zinc-600"
                    aria-hidden="true"/>
                </MenuButton>
              </div>

              <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
              >
                <MenuItems
                  class="absolute z-10 right-[1.5rem] top-[0] w-32 origin-top-right divide-y divide-gray-100 rounded-sm bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <button
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                        ]"
                        @click="editProduct(product)"
                      >
                        <PencilIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-zinc-900"
                          aria-hidden="true"
                        />
                        Edit
                      </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <button
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                        ]"
                        @click="deleteProduct(product)"
                      >
                        <TrashIcon
                          :active="active"
                          class="mr-2 h-5 w-5 text-zinc-900"
                          aria-hidden="true"
                        />
                        Delete
                      </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
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
import {PRODUCTS_PER_PAGE} from '../../constants'
import TableHeaderCell from '../../components/core/Table/TableHeaderCell.vue';
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {DotsVerticalIcon, PencilIcon, TrashIcon} from '@heroicons/vue/outline'

const emit = defineEmits(['clickEdit'])

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
    per_page: perPage.value,
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

function editProduct(product) {
  emit('clickEdit', product)
}

function deleteProduct(product) {
  if(!confirm(`Are you sure you want to delete the product?`)) {
    return
  }
  store.dispatch('deleteProduct', product.id)
    .then(res => {
      // TODO show notification (after delete)
      store.dispatch('getProducts')
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
