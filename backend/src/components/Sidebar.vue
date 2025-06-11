<template>
    <div
        class="w-[200px] transition-all bg-black text-zinc-400 font-sans py-4 px-2 md:hidden block"
    >
        <div class="mt-4 mb-6 pb-5 border-b-[1px]">
            <router-link :to="{ name: 'app.dashboard' }" class="mx-auto">
                <span class="px-2">{{ businessName }}</span>
                <span
                    class="rounded-full px-1 uppercase text-xs text-black font-base mb-4"
                    :class="{
                        'bg-red-600': DEMO,
                        'bg-green-600': LIVE,
                        'bg-blue-500': STAGING,
                        'bg-purple-600': LOCAL,
                    }"
                >
                    {{ status }}
                </span>
            </router-link>
        </div>
        <router-link
            :to="{ name: 'app.dashboard' }"
            :class="{ 'text-white': $route.name === 'app.dashboard' }"
            class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white"
        >
            <span class="text-md"> Dashboard </span>
        </router-link>
        <router-link
            :to="{ name: 'app.products' }"
            :class="{ 'text-white': $route.name === 'app.products' }"
            class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white"
        >
            <span class="text-md"> Products </span>
        </router-link>
        <router-link
            :to="{ name: 'app.orders' }"
            :class="{ 'text-white': $route.name === 'app.orders' }"
            class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white"
        >
            <span class="text-md"> Orders </span>
        </router-link>
        <router-link
            :to="{ name: 'app.customers' }"
            :class="{ 'text-white': $route.name === 'app.customers' }"
            class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white"
        >
            <span class="text-md"> Customers </span>
        </router-link>
        <router-link
            :to="{ name: 'app.users' }"
            :class="{ 'text-white': $route.name === 'app.users' }"
            class="flex items-center py-2 px-10 mb-4 rounded transition-colors hover:bg-zinc-800 hover:text-white"
        >
            <span class="text-md"> Users </span>
        </router-link>
    </div>
</template>

<script>
import { DEMO, LIVE, STAGING, LOCAL, BUSINESS_NAME } from "../constants.js";

export default {
    data() {
        return {
            businessName: BUSINESS_NAME,
        };
    },
    computed: {
        status() {
            if (DEMO) return "demo";
            if (STAGING) return "staging";
            if (LIVE) return "live";
            if (LOCAL) return "local";
        },
    },
};
</script>

<style scoped></style>
