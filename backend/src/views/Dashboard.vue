<template>
    <h1 class="text-lg font-normal mb-3">Dashboard</h1>

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
        <div
            class="bg-white py-6 lg:col-span-2 px-5 rounded border text-lg flex flex-col justify-center"
        >
            Latest Orders
             <template v-if="!loading.latestOrders">
                <pre>
                    {{ latestOrders }}
                </pre>
            </template>
            <Spinner v-else text="" class="" />
        </div>
        <div class="md:grid grid-cols-1">
            <div
                class="bg-white md:py-6 lg:py-10 xl:py-16 md:row-span-2 lg:h-[20vw] rounded border text-lg flex flex-col items-center justify-center"
            >
                <label class="text-lg font-semibold block mb-2"
                    >Orders by Country</label
                >
                <template v-if="!loading.ordersByCountry">
                    <DoughnutChart
                        :width="140"
                        :height="200"
                        :data="ordersByCountry"
                    />
                </template>
                <Spinner v-else text="" class="" />
            </div>
            <div class="bg-white py-8 md:row-span-5 px-8 rounded border text-lg mt-3 font-medium">
                <div v-if="latestCustomers">
                    Latest Customers
                    <router-link
                        :to="`/customers/${c.id}`"
                        v-for="c of latestCustomers"
                        :key="c.id"
                        class="flex mt-3 items-center font-light hover:underline"
                    >
                        <div class="w-10 h-10 bg-gray-200 flex items-center justify-center rounded-full mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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
        </div>
    </div>
</template>

<script setup>
import DoughnutChart from "../components/core/Charts/Doughnut.vue";
import axiosClient from "../axios.js";
import { computed, onMounted, ref } from "vue";
import Spinner from "../components/core/Spinner.vue";

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
const ordersByCountry = ref({});
const latestCustomers = ref({});
const latestOrders = ref({});

axiosClient.get("/dashboard/customers-count").then(({ data }) => {
    customersCount.value = data;
    loading.value.customersCount = false;
});

axiosClient.get("/dashboard/products-count").then(({ data }) => {
    productsCount.value = data;
    loading.value.productsCount = false;
});

axiosClient.get("/dashboard/orders-count").then(({ data }) => {
    paidOrders.value = data;
    loading.value.paidOrders = false;
});

axiosClient.get("/dashboard/income-amount").then(({ data }) => {
    totalIncome.value = new Intl.NumberFormat("en-UK", {
        style: "currency",
        currency: "EUR",
    }).format(data);
    loading.value.totalIncome = false;
});

axiosClient.get("/dashboard/orders-by-country").then(({ data: countries }) => {
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

axiosClient.get("/dashboard/latest-customers").then(({ data: customers }) => {
    latestCustomers.value = customers
    loading.value.latestCustomers = false;
});

axiosClient.get("/dashboard/latest-orders").then(({ data: orders }) => {
    latestOrders.value = orders
    loading.value.latestOrders = false;
});
</script>

<style scoped></style>
