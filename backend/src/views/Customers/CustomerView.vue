<template>
    <div v-if="customer.id" class="my-4">
        <form @submit.prevent="onSubmit">
            <div class="px-4 pb-4">
                <div class="border-b border-gray-300">
                    <h1 class="flex text-xl pb-2">
                        <span class="font-semibold mr-2">
                            Update Customer:
                        </span>
                        {{ customerName }}
                        <span class="text-sm ml-4"
                            ><CustomerStatus :customer="customer"
                        /></span>
                    </h1>
                </div>
                <CustomInput
                    class="mb-5 mt-5"
                    v-model="customer.first_name"
                    label="First Name"
                    :errors="errors.first_name"
                />
                <CustomInput
                    class="mb-5"
                    v-model="customer.last_name"
                    label="Last Name"
                    :errors="errors.last_name"
                />
                <CustomInput
                    class="mb-5"
                    v-model="customer.email"
                    label="Email"
                    :errors="errors.email"
                />
                <CustomInput
                    class="mb-5"
                    v-model="customer.phone"
                    label="Phone"
                    :errors="errors.phone"
                />
                <CustomInput
                    type="checkbox"
                    class="mb-5 mt-8"
                    v-model="customer.status"
                    label="Active Customer"
                    :errors="errors.status"
                />
                <!-- Billing -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2
                            class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300"
                        >
                            Billing Address
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-5">
                            <CustomInput
                                class="mb-5"
                                v-model="customer.billingAddress.address1"
                                label="Address 1"
                                :errors="errors['billingAddress.address1']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.billingAddress.address2"
                                label="Address 2"
                                :errors="errors['billingAddress.address2']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.billingAddress.city"
                                label="City"
                                :errors="errors['billingAddress.city']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.billingAddress.zipcode"
                                label="Zip Code"
                                :errors="errors['billingAddress.zipcode']"
                            />
                            <CustomInput
                                class="mb-5"
                                type="select"
                                :select-options="countries"
                                v-model="customer.billingAddress.country_code"
                                label="Country"
                                :errors="errors['billingAddress.country_code']"
                            />
                            <CustomInput
                                class="mb-5"
                                type="text"
                                v-model="customer.billingAddress.county"
                                label="County"
                                :errors="errors['billingAddress.county']"
                            />
                        </div>
                    </div>
                    <!-- End Billing -->
                    <!-- Shipping -->
                    <div>
                        <h2
                            class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300"
                        >
                            Shipping Address
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-5">
                            <CustomInput
                                class="mb-5"
                                v-model="customer.shippingAddress.address1"
                                label="Address 1"
                                :errors="errors['shippingAddress.address1']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.shippingAddress.address2"
                                label="Address 2"
                                :errors="errors['shippingAddress.address2']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.shippingAddress.city"
                                label="City"
                                :errors="errors['shippingAddress.city']"
                            />
                            <CustomInput
                                class="mb-5"
                                v-model="customer.shippingAddress.zipcode"
                                label="Zip Code"
                                :errors="errors['shippingAddress.zipcode']"
                            />
                            <CustomInput
                                class="mb-5"
                                type="select"
                                :select-options="countries"
                                v-model="customer.shippingAddress.country_code"
                                label="Country"
                                :errors="errors['shippingAddress.country_code']"
                            />
                            <CustomInput
                                class="mb-5"
                                type="text"
                                v-model="customer.shippingAddress.county"
                                label="County"
                                :errors="errors['shippingAddress.county']"
                            />
                        </div>
                    </div>
                    <!-- End Shipping -->
                </div>
            </div>
            <footer class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                    type="submit"
                    class="mt-3 w-full inline-flex justify-center border rounded-sm px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto text-white bg-green-600 hover:bg-green-700"
                >
                    Submit
                </button>
                <router-link
                    :to="{ name: 'app.customers' }"
                    type="button"
                    class="group bg-zinc-300 text-black flex items-center rounded-sm px-4 py-2 hover:bg-zinc-400"
                    ref="cancelButtonRef"
                >
                    Cancel
                </router-link>
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import store from "../../store";
import { useRoute, useRouter } from "vue-router";
import CustomInput from "../../components/core/CustomInput.vue";
import CustomerStatus from "./CustomerStatus.vue";

const router = useRouter();
const route = useRoute();

const customerName = ref("");
const errors = ref({
    first_name: [],
    last_name: [],
    email: [],
    phone: [],
    status: [],
    "billingAddress.address1": [],
    "billingAddress.address2": [],
    "billingAddress.city": [],
    "billingAddress.zipcode": [],
    "billingAddress.country_code": [],
    "billingAddress.county": [],
    "shippingAddress.address1": [],
    "shippingAddress.address2": [],
    "shippingAddress.city": [],
    "shippingAddress.zipcode": [],
    "shippingAddress.country_code": [],
    "shippingAddress.county": [],
});
const customer = ref({
    billingAddress: {},
    shippingAddress: {},
});
const loading = ref(false);

const countries = computed(() =>
    store.state.countries.map((c) => ({ key: c.code, text: c.name }))
);

function onSubmit() {
    loading.value = true;
    if (customer.value.id) {
        console.log(customer.value.status); // boolean
        customer.value.status = !!customer.value.status;
        store
            .dispatch("updateCustomer", customer.value)
            .then((response) => {
                loading.value = false;
                if (response.status === 200) {
                    // TODO show notification
                    store.dispatch("getCustomers");
                    router.push({ name: "app.customers" });
                }
            })
            .catch((err) => {
                errors.value = err.response.data.errors;
            });
    } else {
        store
            .dispatch("createCustomer", customer.value)
            .then((response) => {
                loading.value = false;
                if (response.status === 201) {
                    // TODO show notification
                    store.dispatch("getCustomers");
                    router.push({ name: "app.customers" });
                }
            })
            .catch((err) => {
                loading.value = false;
                debugger;
            });
    }
}

onMounted(() => {
    store.dispatch("getCustomer", route.params.id).then(({ data }) => {
        customerName.value = `${data.first_name} ${data.last_name}`;
        customer.value = data;
    });
});
</script>

<style scoped></style>
