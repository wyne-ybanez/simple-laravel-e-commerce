<template>
    <div v-if="order">
        <!--  Order Details-->
        <div class="my-4">
            <div class="flex justify-between border-b border-gray-300">
                <h2 class="flex text-lg pb-2">
                    Order Details
                    <span class="text-sm ml-4"
                        ><OrderStatus :order="order"
                    /></span>
                </h2>
                <button
                    class="group bg-zinc-300 text-black flex items-center rounded-sm px-4 py-1 mb-2 hover:bg-zinc-400"
                    @click="deleteOrder(order)"
                >
                    Delete
                </button>
            </div>
            <table class="mt-2">
                <tbody>
                    <tr>
                        <td class="font-bold py-1 px-2">Order ID</td>
                        <td>{{ order.id }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 px-2">Order Date</td>
                        <td>{{ order.created_at }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 px-2">Order Status</td>
                        <td>
                            <select
                                v-model="order.status"
                                @change="onStatusChange"
                                class="p-2"
                            >
                                <option
                                    v-for="status of orderStatuses"
                                    :value="status"
                                >
                                    {{ status }}
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 px-2">SubTotal</td>
                        <td>{{ $filters.currencyEU(order.total_price) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--/  Order Details-->

        <!--  Customer Details-->
        <div class="my-10">
            <h2 class="text-lg mt-6 pb-2 border-b border-gray-300">
                Customer Details
                <span class="text-sm ml-4"
                    ><OrderCustomerStatus :order="order"
                /></span>
            </h2>
            <table class="mt-2">
                <tbody>
                    <tr>
                        <td class="font-bold py-1 px-2">Full Name</td>
                        <td>
                            {{ order.customer.first_name }}
                            {{ order.customer.last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 px-2">Email</td>
                        <td>{{ order.customer.email }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 px-2">Phone</td>
                        <td>{{ order.customer.phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--/  Customer Details-->

        <!--  Addresses Details-->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 my-10">
            <div>
                <h2 class="text-lg mt-6 pb-2 border-b border-gray-300">
                    Billing Address
                    <span class="text-sm ml-4"
                        ><OrderAddressStatus :order="order"
                    /></span>
                </h2>
                <!--  Billing Address Details-->
                <div v-if="order.customer.billingAddress.id" class="px-2 mt-2">
                    {{ order.customer.billingAddress.address1 }}, <br />
                    {{ order.customer.billingAddress.address2 }}, <br />
                    {{ order.customer.billingAddress.city }}, <br />
                    {{ order.customer.billingAddress.zipcode }}, <br />
                    {{ order.customer.billingAddress.county }}, <br />
                    {{ order.customer.billingAddress.country }}
                </div>
                <div v-else class="px-2 mt-4">
                    The customer has not assigned a
                    <strong>Billing Address</strong> for this order. <br />
                    Please contact them to rectify this.
                </div>
                <!--/  Billing Address Details-->
            </div>
            <div>
                <h2 class="text-lg mt-6 pb-2 border-b border-gray-300">
                    Shipping Address
                    <span class="text-sm ml-4"
                        ><OrderAddressStatus :order="order"
                    /></span>
                </h2>
                <!--  Shipping Address Details-->
                <div v-if="order.customer.shippingAddress.id" class="px-2 mt-2">
                    {{ order.customer.shippingAddress.address1 }}, <br />
                    {{ order.customer.shippingAddress.address2 }}, <br />
                    {{ order.customer.shippingAddress.city }}, <br />
                    {{ order.customer.shippingAddress.zipcode }}, <br />
                    {{ order.customer.shippingAddress.county }}, <br />
                    {{ order.customer.shippingAddress.country }}
                </div>
                <div v-else class="px-2 mt-4 mb-16">
                    The customer has not assigned a
                    <strong>Shipping Address</strong> for this order. <br />
                    Please contact them to rectify this.
                </div>
                <!--/  Shipping Address Details-->
            </div>
        </div>
        <!--/  Customer Details-->

        <!--    Order Items-->
        <div class="my-10">
            <h2 class="text-lg mt-6 pb-2 border-b border-gray-300">
                Order Items
            </h2>
            <div v-for="item of order.items">
                <!-- Order Item -->
                <div class="flex flex-col sm:flex-row items-center gap-4 mt-2">
                    <a
                        :href="productUrlPrefix + item.product.slug"
                        target="_blank"
                        class="w-36 h-32 flex items-center justify-center overflow-hidden my-2 rounded"
                    >
                        <img
                            :src="item.product.image"
                            class="object-cover rounded"
                            alt=""
                        />
                    </a>
                    <div class="flex flex-col justify-between flex-1">
                        <div class="flex justify-between mb-3 font-semibold">
                            <h3>
                                {{ item.product.title }}
                            </h3>
                        </div>
                        <div class="flex space-x-10 items-center">
                            <div class="flex items-center">
                                Quantity:
                                <span class="ml-4">{{ item.quantity }}</span>
                            </div>
                            <div>x</div>
                            <span class="text-lg">
                                {{ item.unit_price }}
                            </span>
                        </div>
                    </div>
                </div>
                <!--/ Order Item -->
            </div>
        </div>
        <!--/    Order Items-->
    </div>
</template>

<script>
import store from "../../store/index.js";
import axiosClient from "../../axios.js";
import OrderStatus from "./OrderStatus.vue";
import OrderAddressStatus from "./OrderAddressStatus.vue";
import OrderCustomerStatus from "./OrderCustomerStatus.vue";
import { APP_URL } from "../../constants.js";

export default {
    components: {
        OrderStatus,
        OrderAddressStatus,
        OrderCustomerStatus,
    },
    data() {
        return {
            order: null,
            orderStatuses: [],
            productUrlPrefix: `${APP_URL}/product/`,
        };
    },
    mounted() {
        store.dispatch("getOrder", this.$route.params.id).then(({ data }) => {
            this.order = data;
        });
        axiosClient
            .get("api/orders/statuses")
            .then(({ data }) => (this.orderStatuses = data));
    },
    methods: {
        deleteOrder(order) {
            if (!confirm(`Are you sure you want to delete the order?`)) {
                return;
            }
            store.dispatch("deleteOrder", order.id).then((response) => {
                this.$router.push({ name: "app.orders" }); // back to orders index
            });
        },

        onStatusChange() {
            axiosClient.post(
                `/orders/change-status/${this.order.id}/${this.order.status}`
            );
        },
    },
};
</script>

<style scoped></style>
