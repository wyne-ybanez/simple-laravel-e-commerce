<template>
    <th @click="emit('click', field)" class="border-b p-2 text-left">
        <div class="flex">
            <!-- Title slot -->
            <slot></slot>
            <!-- End title slot -->
            <div v-if="sortField === field" class="ml-2">
                <!-- sort asc -->
                <svg v-if="sortDirection === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                </svg>
                <!-- default sort desc -->
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </th>
</template>

<script setup>

const {field, sortField, sortDirection} = defineProps({
    field: String,
    sortField: String,
    sortDirection: String,
})

const emit = defineEmits(['click'])

</script>

<style scoped>
</style>