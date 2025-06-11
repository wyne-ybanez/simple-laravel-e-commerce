<template>
    <span
        class="text-black py-1 px-2 rounded-full uppercase text-xs"
        :class="{
            'bg-violet-400': !order.customer.email || !order.customer.phone,
            'bg-green-400': order.customer.email && order.customer.phone,
            '!bg-stone-300': order.status === 'cancelled',
            'bg-red-400': !order.customer,
        }"
    >
        {{ customerStatus }}
    </span>
</template>

<script>
import { computed, onMounted, ref } from "vue";

export default {
    props: {
        order: Object,
    },
    computed: {
        customerStatus() {
            if (!this.order.customer || !this.order.customer.id) {
                return "error";
            }
            if (!this.order.customer.email || !this.order.customer.phone) {
                if (this.order.status === "cancelled") {
                    return "cancelled";
                }
                return "incomplete";
            }
            if (this.order.status === "cancelled") {
                return "cancelled";
            }
            return "complete";
        },
    },
};
</script>
