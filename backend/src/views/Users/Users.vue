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
    <UserModal v-model="showModal" :user="userModel" @close="onModalClose" />
</template>

<script setup>
import UserModal from "./UserModal.vue";
import UsersTable from "./UsersTable.vue";
import { computed, ref } from "vue";
import store from "../../store";

// Default form values
const DEFAULT_USER = {
    id: "",
    title: "",
    description: "",
    category: "",
    image: "",
    image_1: "",
    image_2: "",
    image_3: "",
    price: "",
    color: "",
};

const users = computed(() => store.state.users);

const userModel = ref({ ...DEFAULT_USER });
const showModal = ref(false);

function showUserModal() {
    showModal.value = true;
}

function editUser(user) {
    userModel.value = user;
    showUserModal();
}

function onModalClose() {
    // resets form
    userModel.value = { ...DEFAULT_USER };
}
</script>

<style scoped></style>
