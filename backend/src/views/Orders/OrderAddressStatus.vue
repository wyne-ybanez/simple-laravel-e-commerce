<template>
    <span class="text-black py-1 px-2 rounded-full uppercase text-xs" :class="{
        'bg-violet-400': order.customer.billingAddress.id == '' || order.customer.shippingAddress.id == '',
        'bg-green-400': order.customer.billingAddress.id || order.customer.shippingAddress.id,
        '!bg-stone-300': order.status === 'cancelled',
        'bg-red-400': !order.customer.id
      }">
      {{ addressStatus }}
    </span>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";

const {order} = defineProps({
  order: Object
})

const addressStatus = computed(() => {
    if (order.status === 'cancelled') {
        return 'cancelled'
    }

    if (order.customer.billingAddress.id == '' || order.customer.shippingAddress.id == '') {
        return 'incomplete'
    }

    if (!order.customer.id) {
        return 'error'
    }

    return 'complete'
})
</script>