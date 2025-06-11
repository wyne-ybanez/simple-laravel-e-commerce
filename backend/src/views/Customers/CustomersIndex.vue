<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Customers</h1>
    </div>
    <CustomersTable />
</template>

<script>
import store from "../../store/index.js";
import CustomersTable from "./CustomersTable.vue";

export default {
    components: {
        CustomersTable,
    },
    data() {
        return {
            customerModel: {},
        };
    },
    computed: {
        customers() {
            return store.state.customers;
        },
    },
    methods: {
        editCustomer(c) {
            store.dispatch("getCustomer", c.id).then(({ data }) => {
                this.customerModel = data;
            });
        },
    },
};
</script>

<style scoped></style>
