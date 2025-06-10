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

<script setup>
import ProductsTable from "./ProductsTable.vue";
import { ref } from "vue";
import store from "../../store";

// Default form values
const DEFAULT_PRODUCT = {
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
};

const productModel = ref({ ...DEFAULT_PRODUCT });

function editProduct(product) {
    store.dispatch("getProduct", product.id).then(({ data }) => {
        productModel.value = data;
    });
}
</script>

<style scoped></style>
