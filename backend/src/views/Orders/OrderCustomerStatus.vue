<template>
    <span class="text-black py-1 px-2 rounded-full uppercase text-xs" :class="{
        'bg-orange-300': !order.customer.email || !order.customer.phone ,
        'bg-green-400': order.customer.email && order.customer.phone,
        'bg-gray-300': order.status === 'cancelled',
        'bg-red-400': !order.customer,
      }">
      {{ customerStatus }}
    </span>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";

const {order} = defineProps({
  order: Object
})

const customerStatus = computed(() => {
    if (!order.customer.email || !order.customer.phone) {
        return 'incomplete'
    }

    if (order.status === 'cancelled') {
        return 'cancelled'
    }

    if (!order.customer || !order.customer.id) {
        return 'error'
    }

    return 'complete'
})

console.log(order.customer);
</script>