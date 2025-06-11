<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Orders</h1>
    </div>
    <OrdersTable />
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../../store";
import OrdersTable from "./OrdersTable.vue";

const orders = computed(() => store.state.orders);
</script>