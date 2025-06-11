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

<script>
export default {
    props: {
        customer: Object,
    },
    computed: {
        customerStatus() {
            if (!this.customer.status) {
                return "disabled";
            }
            if (!this.customer || !this.customer.id) {
                return "error";
            }
            return "active";
        },
    },
};
</script>
