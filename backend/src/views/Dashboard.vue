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
            class="bg-white py-6 lg:col-span-2 px-5 rounded border text-lg flex flex-col items-center justify-center"
        >
            Products
        </div>
        <div class="md:grid grid-cols-1">
            <div
                class="bg-white py-6 md:row-span-2 lg:h-[20vw] rounded border text-lg flex flex-col items-center justify-center"
            >
                <DoughnutChart :data="chartData" />
            </div>
            <div
                class="bg-white py-6 md:row-span-5 px-5 rounded border text-lg flex flex-col items-center justify-center mt-3"
            >
                Customers
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                    occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import DoughnutChart from "../components/core/Charts/Doughnut.vue";
import axiosClient from "../axios.js";
import { computed, onMounted, ref } from "vue";
import Spinner from "../components/core/Spinner.vue";

const chartData = {
    labels: ["Red", "Blue", "Yellow"],
    datasets: [
        {
            data: [300, 50, 100],
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
        },
    ],
};

const loading = ref({
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
});

const customersCount = ref(0);
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);
const ordersByCountry = ref({});

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
axiosClient.get("/dashboard/orders-by-country").then(({ data }) => {
    ordersByCountry.value = data;
});
</script>

<style scoped></style>
