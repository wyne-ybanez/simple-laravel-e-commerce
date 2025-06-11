<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Orders</h1>
    </div>
    <OrdersTable />
</template>

<script>
import { computed } from "vue";
import OrdersTable from "./OrdersTable.vue";

export default {
    components: {
        OrdersTable,
    },
};
</script>
