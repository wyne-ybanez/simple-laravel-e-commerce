<template>
    <span class="text-black py-1 px-2 rounded-full uppercase text-xs" :class="{
        'bg-green-400': ['paid', 'completed'].includes(order.status),
        'bg-orange-400': order.status === 'shipped',
        'bg-stone-300': order.status === 'cancelled',
        'bg-red-400': order.status === 'unpaid',
      }">
      {{ order.status }}
    </span>
</template>

<script setup>
const {order} = defineProps({
  order: Object
})
</script>