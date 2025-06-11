<template>
    <div v-if="currentUser.id" class="min-h-full bg-gray-100 flex">
        <!--    Sidebar-->
        <Sidebar :class="{ '-ml-[200px]': !sidebarOpened }" />
        <!--/    Sidebar-->

        <div class="flex-1">
            <Navbar @toggle-sidebar="toggleSidebar"></Navbar>
            <!--      Content-->
            <main class="p-6">
                <router-view></router-view>
            </main>
            <!--      Content-->
        </div>
    </div>
    <div v-else class="min-h-full bg-gray-100 flex items-center justify-center">
        <Spinner />
    </div>
</template>

<script>
import Spinner from "./core/Spinner.vue";
import Sidebar from "./Sidebar.vue";
import Navbar from "./Navbar.vue";
import store from "../store/index.js";

export default {
    props: {
        title: {
            type: String,
        },
    },
    data() {
        return {
            sidebarOpened: true,
        };
    },
    components: {
        Spinner,
        Sidebar,
        Navbar,
    },
    computed: {
        currentUser() {
            return store.state.user.data;
        },
    },
    methods: {
        toggleSidebar() {
            this.sidebarOpened = !this.sidebarOpened;
        },

        updateSidebarState() {
            this.sidebarOpened = window.outerWidth > 768;
        },
    },
    mounted() {
        store.dispatch("getCurrentUser");
        store.dispatch("getCountries");
        this.updateSidebarState();
        window.addEventListener("resize", this.updateSidebarState);
    },
    unmounted() {
        window.removeEventListener("resize", this.updateSidebarState);
    },
};
</script>

<style scoped></style>
