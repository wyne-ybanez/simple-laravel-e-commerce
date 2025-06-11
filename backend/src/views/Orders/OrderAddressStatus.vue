<template>
    <span
        class="text-black py-1 px-2 rounded-full uppercase text-xs"
        :class="{
            'bg-violet-400':
                order.customer.billingAddress.id == '' ||
                order.customer.shippingAddress.id == '',
            'bg-green-400':
                order.customer.billingAddress.id ||
                order.customer.shippingAddress.id,
            '!bg-stone-300': order.status === 'cancelled',
            'bg-red-400': !order.customer.id,
        }"
    >
        {{ addressStatus }}
    </span>
</template>

<script>
export default {
    props: {
        order: Object,
    },
    computed: {
        addressStatus() {
            if (this.order.status === "cancelled") {
                return "cancelled";
            }
            if (
                this.order.customer.billingAddress.id == "" ||
                this.order.customer.shippingAddress.id == ""
            ) {
                return "incomplete";
            }
            if (!this.order.customer.id) {
                return "error";
            }
            return "complete";
        },
    },
};
</script>
