<template>
    <span
        class="text-black py-1 px-2 rounded-full uppercase text-xs"
        :class="{
            'bg-green-400': customer.status,
            '!bg-stone-300': !customer.status,
            'bg-red-400': !customer || !customer.id,
        }"
    >
        {{ customerStatus }}
    </span>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";

console.log(customer);

const { customer } = defineProps({
    customer: Object,
});

// customer.status is a boolean
const customerStatus = computed(() => {
    if (!customer.status) {
        return "disabled";
    }
    if (!customer || !customer.id) {
        return "error";
    }

    return "active";
});
</script>
