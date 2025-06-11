<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="px-4 my-4">
        <div class="border-b border-gray-300">
            <h1 v-if="!loading" class="flex text-xl pb-2">
                <div v-if="product.id">
                    <span class="font-semibold mr-2">Product:</span
                    >{{ product.title }}
                </div>
                <div v-else>
                    <span class="font-semibold">Create new product</span>
                </div>
            </h1>
        </div>
        <div class="rounded-lg animate-fade-in-down">
            <Spinner
                v-if="loading"
                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"
            />
            <form v-if="!loading" @submit.prevent="onSubmit">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2 lg:col-span-1 pt-5 pb-4">
                        <CustomInput
                            class="mb-5"
                            v-model="product.title"
                            label="Product Title"
                            :errors="errors['title']"
                        />
                        <CustomInput
                            class="mb-5"
                            v-model="product.category"
                            label="Product Category"
                            :errors="errors['category']"
                        />
                        <CustomInput
                            type="richtext"
                            class="mt-5 mb-5"
                            v-model="product.description"
                            label="Description 1"
                            :errors="errors['description']"
                        />
                        <CustomInput
                            type="richtext"
                            class="mt-5 mb-5"
                            v-model="product.description_2"
                            label="Description 2"
                            :errors="errors['description_2']"
                        />
                        <CustomInput
                            type="number"
                            class="mb-5"
                            v-model="product.price"
                            label="Price"
                            prepend="$"
                            :errors="errors['price']"
                        />
                        <CustomInput
                            type="number"
                            class="mb-5"
                            v-model="product.quantity"
                            label="Quantity"
                            :errors="errors['quantity']"
                        />
                        <CustomInput
                            type="checkbox"
                            class="mb-5 mt-8"
                            v-model="product.color"
                            label="Color"
                            :errors="errors['color']"
                        />
                        <CustomInput
                            type="checkbox"
                            class="mb-6 mt-5"
                            v-model="product.published"
                            label="Published"
                            :errors="errors['published']"
                        />
                    </div>
                    <div class="col-span-2 lg:col-span-1 lg:mt-14 pb-4">
                        <!-- Image inputs -->
                        <div class="flex flex-col gap-6">
                            <div
                                class="flex lg:flex-row sm:flex-col items-center rounded border border-gray-300 p-6 lg:w-fit"
                            >
                                <CustomInput
                                    type="file"
                                    class="mt-8 mb-2"
                                    label="Main Product Image"
                                    @change="(file) => (product.image = file)"
                                />
                                <img
                                    class="w-40 h-40 object-cover ml-6"
                                    :src="product.image_url"
                                    v-if="product.image_url"
                                />
                            </div>
                            <div
                                class="flex lg:flex-row sm:flex-col items-center rounded border border-gray-300 p-6 lg:w-fit"
                            >
                                <CustomInput
                                    type="file"
                                    class="mt-8 mb-2"
                                    label="Product Image 1"
                                    @change="(file) => (product.image_1 = file)"
                                />
                                <img
                                    class="w-40 h-40 object-cover ml-6"
                                    :src="product.image_url_1"
                                    v-if="product.image_url_1"
                                />
                            </div>
                            <div
                                class="flex lg:flex-row sm:flex-col items-center rounded border border-gray-300 p-6 lg:w-fit"
                            >
                                <CustomInput
                                    type="file"
                                    class="mt-8 mb-2"
                                    label="Product Image 2"
                                    @change="(file) => (product.image_2 = file)"
                                />
                                <img
                                    class="w-40 h-40 object-cover ml-6"
                                    :src="product.image_url_2"
                                    v-if="product.image_url_2"
                                />
                            </div>
                            <div
                                class="flex lg:flex-row sm:flex-col items-center rounded border border-gray-300 p-6 lg:w-fit"
                            >
                                <CustomInput
                                    type="file"
                                    class="mt-8 mb-2"
                                    label="Product Image 3"
                                    @change="(file) => (product.image_3 = file)"
                                />
                                <img
                                    class="w-40 h-40 object-cover ml-6"
                                    :src="product.image_url_3"
                                    v-if="product.image_url_3"
                                />
                            </div>
                            <!-- End image inputs -->
                        </div>
                        <!-- <treeselect v-model="product.categories" :multiple="true" :options="options" :errors="errors['categories']"/> -->
                    </div>
                    <div class="col-span-1 px-4 pt-5 pb-4">
                        <image-preview
                            v-model="product.images"
                            :images="product.images"
                            v-model:deleted-images="product.deleted_images"
                            v-model:image-positions="product.image_positions"
                        />
                    </div>
                </div>
                <footer class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button
                        type="submit"
                        class="mt-3 w-full inline-flex justify-center border rounded-sm px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto text-white bg-green-600 hover:bg-green-700"
                    >
                        Save
                    </button>
                    <button
                        type="button"
                        @click="onSubmit($event, true)"
                        class="mt-3 w-full inline-flex justify-center border rounded-sm px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto text-white bg-green-600 hover:bg-green-700"
                    >
                        Save & Close
                    </button>
                    <router-link
                        :to="{ name: 'app.products' }"
                        class="group bg-zinc-300 text-black flex items-center rounded-sm px-4 py-2 hover:bg-zinc-400"
                        ref="cancelButtonRef"
                    >
                        Cancel
                    </router-link>
                </footer>
            </form>
        </div>
    </div>
</template>

<script>
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import axiosClient from "../../axios.js";

export default {
    components: {
        CustomInput,
        Spinner,
    },
    emits: ["update:modelValue", "close"],
    data() {
        return {
            product: {
                id: null,
                title: null,
                images: [],
                image: null,
                image_1: null,
                image_2: null,
                image_3: null,
                deleted_images: [],
                image_positions: {},
                description: "",
                description_2: "",
                price: null,
                quantity: null,
                color: false,
                published: false,
                categories: [],
            },
            errors: {},
            loading: false,
            options: [],
        };
    },
    mounted() {
        if (this.$route.params.id) {
            this.loading = true;
            store
                .dispatch("getProduct", this.$route.params.id)
                .then((response) => {
                    this.loading = false;
                    this.product = response.data;
                });
        }
    },
    methods: {
        onSubmit($event, close = false) {
            this.loading = true;
            this.errors = {};
            if (this.product.id) {
                store
                    .dispatch("updateProduct", this.product)
                    .then((response) => {
                        this.loading = false;
                        if (response.status === 200) {
                            this.product = response.data;
                            store.dispatch("getProducts");
                            if (close) {
                                this.$router.push({ name: "app.products" });
                            }
                        }
                    })
                    .catch((err) => {
                        this.loading = false;
                        this.errors = err.response.data.errors;
                    });
            } else {
                store
                    .dispatch("createProduct", this.product)
                    .then((response) => {
                        this.loading = false;
                        if (response.status === 201) {
                            this.product = response.data;
                            store.dispatch("getProducts");
                            if (close) {
                                this.$router.push({ name: "app.products" });
                            } else {
                                this.product = response.data;
                                this.$router.push({
                                    name: "app.products.show",
                                    params: { id: response.data.id },
                                });
                            }
                        }
                    })
                    .catch((err) => {
                        this.loading = false;
                        this.errors = err.response.data.errors;
                    });
            }
        },
    },
};
</script>
