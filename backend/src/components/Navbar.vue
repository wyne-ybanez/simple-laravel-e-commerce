<template>
    <header
        class="flex justify-between items-center pt-9 pb-9 px-6 shadow bg-zinc-200 text-black"
    >
        <!-- Hamburger -->
        <button
            @click="emit('toggle-sidebar')"
            class="flex items-center justify-center rounded transition-colors w-8 h-8 text-zinc-500 hover:text-white md:hidden block"
        >
            <MenuIcon class="w-6" />
        </button>

        <!-- Site name -->
        <div class="text-black md:block hidden">
            <a :href="appURL" target="_blank">
                <span class="pr-2">{{ businessName }}</span>
                <span
                    class="rounded-full px-2 py-[2px] uppercase text-xs text-white font-base"
                    :class="{
                        'bg-red-600': DEMO,
                        'bg-green-600': LIVE,
                        'bg-blue-500': STAGING,
                        'bg-purple-600': LOCAL,
                    }"
                >
                    {{ status }}
                </span>
            </a>
        </div>

        <!-- Navbar links -->
        <div class="text-zinc-600 justify-between md:block hidden">
            <router-link
                :to="{ name: 'app.dashboard' }"
                :class="{ 'text-zinc-400' : $route.name === 'app.dashboard' }"
                class="py-2 px-5 mb-4 transition-colors hover:text-zinc-400 active:text-white"
            >
                <span class="text-md"> Dashboard </span>
            </router-link>
            <router-link
                :to="{ name: 'app.products' }"
                :class="{ 'text-zinc-400' : $route.name === 'app.products' }"
                class="py-2 px-5 mb-4 transition-colors hover:text-zinc-400"
            >
                <span class="text-md"> Products </span>
            </router-link>
            <router-link
                :to="{ name: 'app.customers' }"
                :class="{ 'text-zinc-400' : $route.name === 'app.customers' }"
                class="py-2 px-5 mb-4 transition-colors hover:text-zinc-400"
            >
                <span class="text-md"> Customers </span>
            </router-link>
            <router-link
                :to="{ name: 'app.orders' }"
                :class="{ 'text-zinc-400' : $route.name === 'app.orders' }"
                class="py-2 px-5 mb-4 transition-colors hover:text-zinc-400"
            >
                <span class="text-md"> Orders </span>
            </router-link>
            <router-link
                :to="{ name: 'app.users' }"
                :class="{ 'text-zinc-400' : $route.name === 'app.users' }"
                class="py-2 px-5 mb-4 transition-colors hover:text-zinc-400"
            >
                <span class="text-md"> Users </span>
            </router-link>
        </div>

        <!-- Avatar dropdown -->
        <Menu as="div" class="relative inline-block text-left">
            <MenuButton
                class="flex items-center text-black hover:text-zinc-400"
            >
                <img
                    src="https://randomuser.me/api/portraits/men/1.jpg"
                    class="rounded-full w-8 mr-2"
                />
                <small class="">{{ currentUser.name }}</small>
                <ChevronDownIcon class="h-5 w-5" aria-hidden="true" />
            </MenuButton>
            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-sm bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'bg-zinc-200/50 text-gray-900'
                                        : '',
                                    'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                                ]"
                            >
                                <UserIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-black"
                                    aria-hidden="true"
                                />
                                Profile
                            </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <button
                                @click="logout"
                                :class="[
                                    active
                                        ? 'bg-zinc-200/50 text-gray-900'
                                        : '',
                                    'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                                ]"
                            >
                                <LogoutIcon
                                    :active="active"
                                    class="mr-2 h-5 w-5 text-red-500"
                                    aria-hidden="true"
                                />
                                Logout
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </header>
</template>

<script setup>
import { MenuIcon, LogoutIcon, UserIcon } from "@heroicons/vue/outline";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import { DEMO, LIVE, STAGING, LOCAL, BUSINESS_NAME, APP_URL } from "../constants.js";
import store from "../store";
import router from "../router";
import { ref, computed } from "vue";

const emit = defineEmits(["toggle-sidebar"]);

// controlled in 'constants.js'
const businessName = ref(BUSINESS_NAME);
const appURL = ref(APP_URL);

const status = computed(() => {
    if (DEMO) {
        return "demo";
    }
    if (STAGING) {
        return "staging";
    }
    if (LIVE) {
        return "live";
    }
    if (LOCAL) {
        return "local";
    }
});

const currentUser = computed(() => store.state.user.data);

function logout() {
    store.dispatch("logout").then(() => {
        router.push({ name: "login" });
    });
}
</script>

<style scoped></style>
