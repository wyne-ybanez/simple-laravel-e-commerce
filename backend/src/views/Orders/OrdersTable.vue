<template>
    <div class="bg-white p-4 rounded border animate-fade-in">
        <div class="flex justify-between pb-5">
            <div class="flex items-center">
                <!-- List options -->
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select
                    v-model="perPage"
                    @change="getOrders(null)"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 bg-gray-50 text-gray-900 rounded-sm focus:outline-none focus:ring-zinc-500 focus:border-0 focus:z-10 cursor-pointer sm:text-sm"
                >
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ml-3">{{ orders.total }} Orders</span>
            </div>
            <!-- Search -->
            <div>
                <input
                    v-model="search"
                    @change="getOrders(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm placeholder:text-slate-400"
                    placeholder="Search Orders"
                />
            </div>
        </div>
        <!-- Orders table -->
        <table class="table-auto w-full">
            <thead class="text-left">
                <tr>
                    <TableHeaderCell
                        @click="sortOrders('id')"
                        class="border-b p-2 pb-5 font-medium"
                        field="id"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        ID
                    </TableHeaderCell>
                    <TableHeaderCell
                        class="border-b p-2 pb-5 font-medium cursor-default"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Customer
                    </TableHeaderCell>
                    <TableHeaderCell
                        class="border-b p-2 pb-5 font-medium cursor-default"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Status
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortOrders('total_price')"
                        class="border-b p-2 pb-5 font-medium"
                        field="total_price"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Price
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortOrders('created_at')"
                        class="border-b p-2 pb-5 font-medium"
                        field="created_at"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Date
                    </TableHeaderCell>
                    <TableHeaderCell
                        field="actions"
                        class="border-b p-2 pb-5 font-medium cursor-default"
                    >
                        Actions
                    </TableHeaderCell>
                </tr>
            </thead>
            <!-- Spinner -->
            <tbody v-if="orders.loading || !orders.data.length">
                <tr>
                    <td colspan="6">
                        <Spinner v-if="orders.loading" class="py-10 h-[65.1vh] justify-center align-center"/>
                        <p v-else class="text-center py-8 text-gray-700">
                            There are no orders.
                        </p>
                    </td>
                </tr>
            </tbody>
            <!-- Table data -->
            <tbody v-if="!orders.loading" class="font-light">
                <!-- Add animation style if needed :style="{'animation-delay': `${index * 0.05}s`}" -->
                <tr
                    v-for="(order, index) of orders.data"
                    class="animate-fade-in"
                >
                    <td class="border-b p-2 py-6">{{ order.id }}</td>
                    <td class="border-b p-2" v-if="order.customer">
                        {{ order.customer.first_name }}
                        {{ order.customer.last_name }}
                    </td>
                    <td class="border-b p-2" v-else>
                        {{ order.user.name }}
                    </td>
                    <td
                        class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis"
                    >
                        <OrderStatus :order="order" />
                    </td>
                    <td class="border-b p-2">
                        {{ order.total_price }}
                    </td>
                    <td class="border-b p-2">
                        {{ order.created_at }}
                    </td>
                    <td class="border-b p-2">
                        <router-link
                            :to="{
                                name: 'app.orders.view',
                                params: { id: order.id },
                            }"
                            class="w-8 h-8 rounded-full text-stone-700 border border-stone-700 flex justify-center items-center hover:text-white hover:bg-black"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-4 h-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Pagination -->
        <div
            v-if="!orders.loading"
            class="flex justify-between items-center mt-5"
        >
            <span v-if="orders.data.length">
                Showing from {{ orders.from }} to {{ orders.to }}
            </span>
            <nav
                v-if="orders.total > orders.limit"
                class="relative z-0 inline-flex justify-center rounded-sm shadow-sm -space-x-px"
                aria-label="Pagination"
            >
                <a
                    v-for="(link, i) of orders.links"
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
                        i === orders.links.length - 1 ? 'rounded-r-sm' : '',
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

<script setup>
import { computed, ref, onMounted } from "vue";
import Spinner from "../../components/core/Spinner.vue";
import store from "../../store";
import { ORDERS_PER_PAGE } from "../../constants.js";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import OrderStatus from "./OrderStatus.vue";

const emit = defineEmits(["clickEdit"]);

const perPage = ref(ORDERS_PER_PAGE);
const search = ref("");
const orders = computed(() => store.state.orders);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

const showOrderModal = ref(false);

onMounted(() => {
    getOrders();
});

function getForPage(e, link) {
    e.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getOrders(link.url);
}

function getOrders(url = null) {
    store.dispatch("getOrders", {
        url,
        search: search.value,
        per_page: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
    });
}

function sortOrders(field) {
    if (field === sortField.value) {
        if (sortDirection.value === "desc") {
            sortDirection.value = "asc";
        } else {
            sortDirection.value = "desc";
        }
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
    getOrders();
}

function showAddNewModal() {
    showOrderModal.value = true;
}

function deleteOrder(order) {
    if (!confirm(`Are you sure you want to delete the order?`)) {
        return;
    }
    store.dispatch("deleteOrder", order.id).then((res) => {
        store.dispatch("getOrders");
    });
}
</script>
