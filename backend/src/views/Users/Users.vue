<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Users</h1>
        <button
            type="submit"
            @click="showUserModal"
            class="py-2 px-6 border border-transparent text-sm font-light rounded-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none"
        >
            Add User
        </button>
    </div>
    <UsersTable @clickEdit="editUser" />
</template>

<script setup>
import UsersTable from "./UsersTable.vue";
import { ref } from "vue";

// Default form values
const DEFAULT_USER = {
    id: "",
    name: "",
    email: "",
    password: "",
    is_admin: "",
};

const userModel = ref({ ...DEFAULT_USER });

function editUser(user) {
    store.dispatch("getUser", user.id).then(({ data }) => {
        user.value = data;
    });
}
</script>

<style scoped></style>
