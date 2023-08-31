<template>
    <span class="text-black py-1 px-2 rounded-full uppercase text-xs" :class="{
        'bg-violet-400': !order.customer.email || !order.customer.phone,
        'bg-green-400': order.customer.email && order.customer.phone,
        '!bg-stone-300': order.status === 'cancelled',
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
    if (!order.customer || !order.customer.id) {
        return 'error'
    }

    if (!order.customer.email || !order.customer.phone) {
        if (order.status === 'cancelled') {
            return 'cancelled'
        }
        return 'incomplete'
    }

    if (order.status === 'cancelled') {
        return 'cancelled'
    }

    return 'complete'
})
</script>