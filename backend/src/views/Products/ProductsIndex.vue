<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Products</h1>
        <router-link
            :to="{ name: 'app.products.create' }"
            class="py-2 px-6 border border-transparent text-sm font-light rounded-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none"
        >
            Add Product
        </router-link>
    </div>
    <ProductsTable @clickEdit="editProduct" />
</template>

<script>
import ProductsTable from "./ProductsTable.vue";
import store from "../../store/index.js";

export default {
    components: {
        ProductsTable,
    },
    data() {
        return {
            // Default form values
            productModel: {
                id: "",
                title: "",
                description: "",
                category: "",
                image: "",
                image_1: "",
                image_2: "",
                image_3: "",
                price: "",
                color: "",
            },
        };
    },
    methods: {
        editProduct(product) {
            store.dispatch("getProduct", product.id).then(({ data }) => {
                this.productModel = data;
            });
        },
    },
};
</script>

<style scoped></style>
