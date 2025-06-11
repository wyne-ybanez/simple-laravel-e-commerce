<template>
    <span
        class="text-black py-1 px-2 rounded-full uppercase text-sm"
        :class="{
            'bg-green-400': ['paid', 'completed'].includes(order.status),
            'bg-orange-300': order.status === 'shipped',
            'bg-gray-300': order.status === 'cancelled',
            'bg-red-400': order.status === 'unpaid',
            'bg-violet-400': order.status === 'incomplete',
        }"
    >
        {{ order.status }}
    </span>
</template>

<script>
export default {
    props: {
        order: Object,
    },
};
</script>
