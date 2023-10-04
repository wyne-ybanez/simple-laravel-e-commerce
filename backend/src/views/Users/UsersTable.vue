<template>
    <div class="bg-white p-4 rounded border animate-fade-in">
        <div class="flex justify-between pb-5">
            <div class="flex items-center">
                <!-- List options -->
                <span class="whitespace-nowrap mr-3">Per Page</span>
                <select
                    v-model="perPage"
                    @change="getUsers(null)"
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 bg-gray-50 text-gray-900 rounded-sm focus:outline-none focus:ring-zinc-500 focus:border-0 focus:z-10 cursor-pointer sm:text-sm"
                >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ml-3"> {{ users.total }} Users</span>
            </div>
            <!-- Search -->
            <div>
                <input
                    v-model="search"
                    @change="getUsers(null)"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm placeholder:text-slate-400"
                    placeholder="Search Users"
                />
            </div>
        </div>
        <!-- Users table -->
        <table class="table-auto w-full">
            <thead class="text-left">
                <tr>
                    <TableHeaderCell
                        @click="sortUsers('id')"
                        class="border-b p-2 pb-5 font-medium"
                        field="id"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        ID
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortUsers('name')"
                        class="border-b p-2 pb-5 font-medium"
                        field=""
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Name
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortUsers('email')"
                        class="border-b p-2 pb-5 font-medium"
                        field="title"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Email
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortUsers('is_admin')"
                        class="border-b p-2 pb-5 font-medium"
                        field="is_admin"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Admin
                    </TableHeaderCell>
                    <TableHeaderCell
                        @click="sortUsers('created_at')"
                        class="font-medium"
                        field="created_at"
                        :sort-field="sortField"
                        :sort-direction="sortDirection"
                    >
                        Created On
                    </TableHeaderCell>
                    <TableHeaderCell field="actions" class="cursor-default font-medium">
                        Actions
                    </TableHeaderCell>
                </tr>
            </thead>
            <!-- Spinner -->
            <tbody v-if="users.loading">
                <tr>
                    <td colspan="6">
                        <Spinner
                            v-if="users.loading"
                            class="py-10 h-[65.1vh] justify-center align-center text-center"
                        />
                        <p v-else class="text-center py-8 text-gray-700">
                            There are no users.
                        </p>
                    </td>
                </tr>
            </tbody>
            <!-- Table data -->
            <tbody v-if="!users.loading" class="font-light">
                <!-- Add animation style if needed :style="{'animation-delay': `${index * 0.05}s`}" -->
                <tr v-for="user of users.data" class="animate-fade-in">
                    <td class="border-b px-2 py-6">{{ user.id }}</td>
                    <td
                        class="border-b px-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis"
                    >
                        {{ user.name }}
                    </td>
                    <td class="border-b px-2">
                        {{ user.email }}
                    </td>
                    <td class="border-b px-2">
                        <!-- Admin Status -->
                        <div class="text-black text-sm py-1 px-2 rounded-full w-fit" :class="{
                            'bg-green-400': ['true', '1', 1, true].includes(user.is_admin),
                            'bg-gray-300': ['false', '0', 0, false].includes(user.is_admin),
                        }"
                        >
                            <span class="py-1" v-if="user.is_admin">
                                Admin
                            </span>
                            <span class="py-1" v-else>
                                Regular
                            </span>
                        </div>
                        <!-- End Admin Status -->
                    </td>
                    <td class="border-b px-2">
                        {{ user.created_at }}
                    </td>
                    <td class="border-y px-2">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="inline-flex items-center justify-center w-full rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                >
                                    <DotsVerticalIcon
                                        class="h-5 w-5 text-zinc-600"
                                        aria-hidden="true"
                                    />
                                </MenuButton>
                            </div>

                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <MenuItems
                                    class="absolute z-10 right-[1.5rem] top-[0] w-32 origin-top-right divide-y divide-gray-100 rounded-sm bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div class="px-1 py-1">
                                        <MenuItem v-slot="{ active }">
                                            <button
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                                                ]"
                                                @click="editUser(user)"
                                            >
                                                <PencilIcon
                                                    :active="active"
                                                    class="mr-2 h-5 w-5 text-zinc-900"
                                                    aria-hidden="true"
                                                />
                                                Edit
                                            </button>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <button
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'group flex w-full items-center rounded-sm px-2 py-2 text-sm',
                                                ]"
                                                @click="deleteUser(user)"
                                            >
                                                <TrashIcon
                                                    :active="active"
                                                    class="mr-2 h-5 w-5 text-zinc-900"
                                                    aria-hidden="true"
                                                />
                                                Delete
                                            </button>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Pagination -->
        <div
            v-if="!users.loading"
            class="flex justify-between items-center mt-5"
        >
            <span> Showing from {{ users.from }} to {{ users.to }} </span>
            <nav
                v-if="users.total > users.limit"
                class="relative z-0 inline-flex justify-center rounded-sm shadow-sm -space-x-px"
                aria-label="Pagination"
            >
                <a
                    v-for="(link, i) of users.links"
                    :key="i"
                    :disabled="!link.url"
                    href="#"
                    @click.prevent="getForPage($event, link)"
                    aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-base whitespace-nowrap"
                    :class="[
                        link.active
                            ? 'z-10 bg-gray-50 border-gray-400 text-gray-500'
                            : 'bg-white border-gray-200 text-gray-500 hover:bg-gray-50',
                        i === 0 ? 'rounded-l-sm' : '',
                        i === users.links.length - 1 ? 'rounded-r-sm' : '',
                        !link.url
                            ? 'hidden hover:bg-gray-50 text-gray-500'
                            : '',
                    ]"
                    v-html="link.label"
                >
                </a>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";
import Spinner from "../../components/core/Spinner.vue";
import store from "../../store";
import { USERS_PER_PAGE } from "../../constants.js";
import TableHeaderCell from "../../components/core/Table/TableHeaderCell.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    DotsVerticalIcon,
    PencilIcon,
    TrashIcon,
} from "@heroicons/vue/outline";

const emit = defineEmits(["clickEdit"]);

const perPage = ref(USERS_PER_PAGE);
const search = ref("");
const users = computed(() => store.state.users);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

const showUserModal = ref(false);

onMounted(() => {
    getUsers();
});

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }

    getUsers(link.url);
}

function getUsers(url = null) {
    store.dispatch("getUsers", {
        url,
        search: search.value,
        per_page: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
    });
}

function sortUsers(field) {
    if (field === sortField.value) {
        if (sortDirection.value === "desc") {
            sortDirection.value = "asc";
        } else {
            sortDirection.value = "desc";
        }
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
    getUsers();
}

function showAddNewModal() {
    showUserModal.value = true;
}

function editUser(user) {
    emit("clickEdit", user);
}

function deleteUser(user) {
    if (!confirm(`Are you sure you want to delete the user?`)) {
        return;
    }
    store.dispatch("deleteUser", user.id).then((res) => {
        // TODO show notification (after delete)
        store.dispatch("getUsers");
    });
}
</script>

<style scoped></style>
