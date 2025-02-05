<template>
    <div class="mb-2 flex items-center justify-between">
        <h1 class="text-lg font-normal mb-3">Dashboard</h1>
        <div class="flex items-center">
        <label class="mr-4">Change Date Period</label>
        <CustomInput type="select" v-model="chosenDate" @change="onDatePickerChange" :select-options="dateOptions"/>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-3">
        <!-- Acive Customers -->
        <div
            class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center"
        >
            <label class="font-light">Active Customers</label>
            <template v-if="!loading.customersCount">
                <span class="text-2xl pt-2">{{ customersCount }}</span>
            </template>
            <Spinner v-else text=" " class="pt-2" />
        </div>
        <!-- End Active Customers -->
        <!-- Acive Products -->
        <div
            class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center"
        >
            <label class="font-light">Active Products</label>
            <template v-if="!loading.productsCount">
                <span class="text-2xl pt-2">{{ productsCount }}</span>
            </template>
            <Spinner v-else text=" " class="pt-2" />
        </div>
        <!-- End Active Products -->
        <!-- Paid Orders -->
        <div
            class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center"
        >
            <label class="font-light">Paid Orders</label>
            <template v-if="!loading.paidOrders">
                <span class="text-2xl pt-2">{{ paidOrders }}</span>
            </template>
            <Spinner v-else text=" " class="pt-2" />
        </div>
        <!-- End Paid Orders -->
        <!-- Total Income -->
        <div
            class="bg-white py-6 px-5 rounded border text-lg flex flex-col items-center justify-center"
        >
            <label class="font-light">Total Income</label>
            <template v-if="!loading.totalIncome">
                <span class="text-2xl pt-2">{{ totalIncome }}</span>
            </template>
            <Spinner v-else text=" " class="pt-2" />
        </div>
        <!-- End Total Income -->
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 my-3">
        <!-- Latest Orders -->
        <div class="bg-white lg:col-span-2 px-8 py-8 rounded">
            <div class="text-lg mb-3">Latest Orders</div>
            <template v-if="!loading.latestOrders">
                <div
                    v-for="o of latestOrders"
                    :key="o.id"
                    class="p-3 hover:bg-gray-100 rounded border-b flex flex-col"
                >
                    <router-link
                        :to="{
                            name: 'app.orders.view',
                            params: { id: o.id },
                        }"
                        class=""
                    >
                        <p>
                            <span class="font-semibold">Order #{{ o.id }}</span>
                        </p>
                        <p class="font-light">created {{ o.created_at }}</p>
                        <p class="font-light">{{ o.items[0].quantity }} item(s)</p>
                        <p class="flex justify-between font-light">
                            <span>{{ o.first_name }} {{ o.last_name }}</span>
                            <span>{{ $filters.currencyEU(o.total_price) }}</span>
                        </p>
                    </router-link>
                </div>
            </template>
        <!-- End Latest Orders -->
        </div>

        <!-- Orders by Country -->
        <div class="md:grid grid-cols-1 lg:col-span-1">
            <div
                class="bg-white md:py-6 lg:py-10 xl:py-16 md:row-span-2 lg:h-[20vw] rounded border text-lg flex flex-col items-center justify-center"
            >
                <label class="text-lg block mb-2">Orders by Country</label>
                <template v-if="!loading.ordersByCountry">
                    <DoughnutChart
                        :width="140"
                        :height="200"
                        :data="ordersByCountry"
                    />
                </template>
                <Spinner v-else text="" class="" />
            </div>
            <!-- End Orders by Country -->
            <!-- Latest Customers -->
            <div class="bg-white py-8 md:row-span-5 px-8 rounded border mt-3">
                <div v-if="latestCustomers">
                    <div class="text-lg">Latest Customers</div>
                    <router-link
                        :to="`/customers/${c.id}`"
                        v-for="c of latestCustomers"
                        :key="c.id"
                        class="flex mt-3 items-center font-light hover:bg-gray-100 p-3 rounded border-b"
                    >
                        <div
                            class="w-10 h-10 bg-gray-200 flex items-center justify-center rounded-full mr-5"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                />
                            </svg>
                        </div>
                        <div>
                            <h3>{{ c.first_name }} {{ c.last_name }}</h3>
                            <p>{{ c.email }}</p>
                        </div>
                    </router-link>
                </div>
                <Spinner v-else text="" class="" />
            </div>
            <!-- End Latest Customers -->
        </div>
    </div>
</template>

<script setup>
import DoughnutChart from "../components/core/Charts/Doughnut.vue";
import axiosClient from "../axios.js";
import { computed, onMounted, ref } from "vue";
import Spinner from "../components/core/Spinner.vue";
import CustomInput from "../components/core/CustomInput.vue";
import {useStore} from "vuex";

const store = useStore();
const dateOptions = computed(() => store.state.dateOptions);
const chosenDate = ref('all')

const loading = ref({
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
    ordersByCountry: true,
    latestCustomers: true,
    latestOrders: true,
});

const customersCount = ref(0);
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);
const ordersByCountry = ref([]);
const latestCustomers = ref([]);
const latestOrders = ref([]);

function updateDashboard() {
    const date = chosenDate.value
    loading.value = {
        customersCount: true,
        productsCount: true,
        paidOrders: true,
        totalIncome: true,
        ordersByCountry: true,
        latestCustomers: true,
        latestOrders: true,
    }

    axiosClient.get("/dashboard/customers-count", {params: {date}}).then(({ data }) => {
        customersCount.value = data;
        loading.value.customersCount = false;
    });

    axiosClient.get("/dashboard/products-count", {params: {date}}).then(({ data }) => {
        productsCount.value = data;
        loading.value.productsCount = false;
    });

    axiosClient.get("/dashboard/orders-count", {params: {date}}).then(({ data }) => {
        paidOrders.value = data;
        loading.value.paidOrders = false;
    });

    axiosClient.get("/dashboard/income-amount", {params: {date}}).then(({ data }) => {
        totalIncome.value = new Intl.NumberFormat("en-DE", {
            style: "currency",
            currency: "EUR",
        }).format(data);
        loading.value.totalIncome = false;
    });

    axiosClient.get("/dashboard/orders-by-country", {params: {date}}).then(({ data: countries }) => {
        const chartData = {
            labels: [],
            datasets: [
                {
                    backgroundColor: [
                        "#41B883",
                        "#36A2EB",
                        "#FFCE56",
                        "#FF3100",
                        "#C0CBFF",
                    ],
                    data: [],
                },
            ],
        };

        countries.forEach((c) => {
            chartData.labels.push(c.name);
            chartData.datasets[0].data.push(c.count);
        });

        ordersByCountry.value = chartData;

        if (countries) {
            loading.value.ordersByCountry = false;
        }
    });

    axiosClient.get("/dashboard/latest-customers", {params: {date}}).then(({ data: customers }) => {
        latestCustomers.value = customers;
        loading.value.latestCustomers = false;
    });

    axiosClient.get(`/dashboard/latest-orders`, {params: {date}}).then(({data: orders}) => {
        latestOrders.value = orders.data;
        loading.value.latestOrders = false;
    })
}

function onDatePickerChange() {
    updateDashboard()
}

onMounted(() => updateDashboard())
</script>

<style scoped></style>
