<template>
    <span class="text-black py-1 px-2 rounded-full uppercase text-xs" :class="{
        'bg-orange-300': !order.customer.email || !order.customer.phone ,
        'bg-green-400': order.customer.email && order.customer.phone,
        'bg-gray-300': order.status === 'cancelled',
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
    } else return 'complete'
})

console.log(order.customer);
</script>