<template>
    <div class="bg-white p-4 rounded border animate-fade-in">
        <div class="flex justify-between pb-5">
            <div class="flex items-center">
                <!-- List options -->
                <span class="mr-3">Per Page</span>
                <select
                    v-model="perPage"
                    @change="getProducts(null)"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 bg-gray-50 text-gray-900 rounded-sm focus:outline-none focus:ring-zinc-500 focus:border-0 focus:z-10 cursor-pointer sm:text-sm"
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
                <input
                    v-model="search"
                    @change="getProducts(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm placeholder:text-slate-400"
                    placeholder="Search Products"
                />
            </div>
        </div>
        <!-- Products table -->
        <table class="table lg:table-auto table-fixed w-fit md:w-full">
            <thead class="text-left">
                <tr>
                    <TableHeaderCell
                        @click="sortProducts('id')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="id"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        ID
                    </TableHeaderCell>
                    <TableHeaderCell
                        class="border-b p-2 pb-5 font-medium"
                        field=""
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Image
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('title')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="title"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Title
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('price')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="price"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Value
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('category')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="category"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Category
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('color')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="color"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Color
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('published')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="published"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Status
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortProducts('updated_at')"
                        class="border-b p-2 pb-5 font-medium cursor-pointer"
                        field="updated_at"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Updated
                    </TableHeaderCell>
                    <TableHeaderCell
                        field="actions"
                        class="cursor-default font-medium"
                    >
                        Actions
                    </TableHeaderCell>
                </tr>
            </thead>
            <!-- Spinner -->
            <tbody v-if="products.loading">
                <tr>
                    <td colspan="8">
                        <Spinner
                            v-if="products.loading"
                            class="py-10 h-[65.1vh] justify-center align-center text-center"
                        />
                        <p v-else class="text-center py-8 text-gray-700">
                            There are no products.
                        </p>
                    </td>
                </tr>
            </tbody>
            <!-- Table data -->
            <tbody v-if="!products.loading" class="font-light">
                <!-- Add animation style if needed :style="{'animation-delay': `${index * 0.05}s`}" -->
                <tr v-for="product of products.data" class="animate-fade-in">
                    <td class="border-b p-2">{{ product.id }}</td>
                    <td class="border-b p-2">
                        <router-link :to="`/products/${product.id}`">
                            <img
                                class="w-16 h-16 object-cover"
                                :src="product.image_url"
                                :alt="product.title"
                            />
                        </router-link>
                    </td>
                    <td
                        class="border-b p-2 max-w-[200px] overflow-hidden text-ellipsis"
                    >
                        <router-link
                            :to="{
                                name: 'app.products.show',
                                params: { id: product.id },
                            }"
                            class="hover:border-b hover:border-zinc-900"
                        >
                            {{ product.title }}
                        </router-link>
                    </td>
                    <td class="border-b p-2">
                        {{ $filters.currencyEU(product.price) }}
                    </td>
                    <td class="border-b p-2">
                        {{ product.category }}
                    </td>
                    <td class="border-b p-2">
                        <!-- Color Notification -->
                        <div
                            class="text-black text-sm py-1 px-2 rounded-full w-fit"
                            :class="{
                                'bg-green-400': ['true', '1', 1, true].includes(
                                    product.color
                                ),
                                'bg-gray-300': [
                                    'false',
                                    '0',
                                    0,
                                    false,
                                ].includes(product.color),
                            }"
                        >
                            <span class="py-1" v-if="product.color">
                                Colored
                            </span>
                            <span class="py-1" v-else> Grayscale </span>
                        </div>
                        <!-- End Color Notification -->
                    </td>
                    <td class="border-b p-2">
                        <div
                            class="text-black text-sm py-1 px-2 rounded-full w-fit"
                            :class="{
                                'bg-green-400': ['true', '1', 1, true].includes(
                                    product.published
                                ),
                                'bg-gray-300': [
                                    'false',
                                    '0',
                                    0,
                                    false,
                                ].includes(product.published),
                            }"
                        >
                            <span class="py-1" v-if="product.published">
                                Published
                            </span>
                            <span class="py-1" v-else> Draft </span>
                        </div>
                    </td>
                    <td class="border-b p-2">
                        {{ product.updated_at }}
                    </td>
                    <td class="border-y p-2">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="inline-flex items-center justify-center w-full rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                >
                                    <DotsVerticalIcon
                                        class="h-5 w-5 text-zinc-600"
                                        aria-hidden="true"
                                    />
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
                                            <router-link
                                                :to="`/products/${product.id}`"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                                                ]"
                                            >
                                                <PencilIcon
                                                    :active="active"
                                                    class="mr-2 h-5 w-5 text-zinc-900"
                                                    aria-hidden="true"
                                                />
                                                Edit
                                            </router-link>
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
        <div
            v-if="!products.loading"
            class="flex justify-between items-center mt-5"
        >
            <span> Showing from {{ products.from }} to {{ products.to }} </span>
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
                        !link.url
                            ? 'hidden hover:bg-gray-50 text-gray-500'
                            : '',
                    ]"
                    v-html="link.label"
                >
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
import Spinner from "../../components/core/Spinner.vue";
import store from "../../store/index.js";
import { PRODUCTS_PER_PAGE } from "../../constants.js";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    DotsVerticalIcon,
    PencilIcon,
    TrashIcon,
} from "@heroicons/vue/outline";

export default {
    components: {
        Spinner,
        TableHeaderCell,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        DotsVerticalIcon,
        PencilIcon,
        TrashIcon,
    },
    data() {
        return {
            perPage: PRODUCTS_PER_PAGE,
            search: "",
            sortField: "updated_at",
            sortDirection: "desc",
        };
    },
    computed: {
        products() {
            return store.state.products;
        },
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts(url = null) {
            store.dispatch("getProducts", {
                url,
                sort_field: this.sortField,
                sort_direction: this.sortDirection,
                search: this.search,
                per_page: this.perPage,
            });
        },

        sortProducts(field) {
            if (field === this.sortField) {
                if (this.sortDirection === "desc") {
                    this.sortDirection = "asc";
                } else {
                    this.sortDirection = "desc";
                }
            } else {
                this.sortField = field;
                this.sortDirection = "asc";
            }
            this.getProducts();
        },

        deleteProduct(product) {
            if (!confirm(`Are you sure you want to delete the product?`)) {
                return;
            }
            store.dispatch("deleteProduct", product.id).then((res) => {
                // TODO show notification (after delete)
                store.dispatch("getProducts");
            });
        },

        getForPage(e, link) {
            if (!link.url || link.active) {
                return;
            }
            this.getProducts(link.url);
        },
    },
};
</script>

<style scoped></style>
