<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-lg font-normal">Users</h1>
        <router-link
            :to="{ name: 'app.users.create' }"
            class="py-2 px-6 border border-transparent text-sm font-light rounded-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none"
        >
            Add User
        </router-link>
    </div>
    <UsersTable @clickEdit="editUser" />
</template>

<script>
import UsersTable from "./UsersTable.vue";
import store from "../../store/index.js";

export default {
    components: {
        UsersTable,
    },
    data() {
        return {
            // Default form values
            userModel: {
                id: "",
                name: "",
                email: "",
                password: "",
                is_admin: "",
            },
        };
    },
    methods: {
        editUser(user) {
            store.dispatch("getUser", user.id).then(({ data }) => {
                this.userModel = data;
            });
        },
    },
};
</script>

<style scoped></style>
