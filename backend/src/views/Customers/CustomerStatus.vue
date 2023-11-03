<template>
    <span
        class="text-black py-1 px-2 rounded-full uppercase text-xs"
        :class="{
            'bg-green-400': customer.status,
            '!bg-stone-300': !customer.status || customer.status === 'inactive',
            'bg-red-400': !customer || !customer.id,
        }"
    >
        {{ customerStatus }}
    </span>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";

const { customer } = defineProps({
    customer: Object,
});

const customerStatus = computed(() => {
    if (!customer.status) {
        return "inactive";
    }

    if (!customer || !customer.id) {
        return "error";
    }

    return "active";
});
</script>
