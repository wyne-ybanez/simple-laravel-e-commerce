<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="px-4 my-4">
        <div class="border-b border-gray-300">
            <h1 v-if="!loading" class="flex text-xl pb-2">
                <div v-if="user.id">
                    <span class="font-semibold mr-2">User:</span>{{ user.name }}
                </div>
                <div v-else>
                    <span class="font-semibold">Add new user</span>
                </div>
            </h1>
        </div>
        <div class="rounded-lg animate-fade-in-down">
            <Spinner
                v-if="loading"
                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"
            />
            <form v-if="!loading" @submit.prevent="onSubmit">
                <div class="grid gap-6">
                    <div class="col-span-2 lg:col-span-1 pt-5 pb-4">
                        <CustomInput
                            class="mt-8 mb-2"
                            v-model="user.name"
                            label="User Name"
                            required
                        />
                        <CustomInput
                            class="mt-8 mb-2"
                            v-model="user.email"
                            label="Email"
                            required
                        />
                        <CustomInput
                            class="mt-8 mb-2"
                            v-model="user.password"
                            label="Password"
                            :required="user.password"
                        />
                    </div>
                </div>
                <footer
                    class="md:px-4 md:py-3 sm:px-6 md:flex md:flex-row-reverse grid gap-6 md:gap-0"
                >
                    <button
                        type="submit"
                        class="w-full inline-flex justify-center border rounded-sm px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto text-white bg-green-600 hover:bg-green-700"
                    >
                        Save
                    </button>
                    <button
                        type="button"
                        @click="onSubmit($event, true)"
                        class="w-full inline-flex justify-center border rounded-sm px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto text-white bg-green-600 hover:bg-green-700"
                    >
                        Save & Close
                    </button>
                    <router-link
                        :to="{ name: 'app.users' }"
                        class="group bg-zinc-300 text-black justify-center flex items-center rounded-sm px-4 py-2 hover:bg-zinc-400"
                        ref="cancelButtonRef"
                    >
                        Cancel
                    </router-link>
                </footer>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import { useRoute, useRouter } from "vue-router";
import axiosClient from "../../axios.js";

const route = useRoute();
const router = useRouter();

const user = ref({
    id: null,
    name: "",
    email: "",
    password: null,
    is_admin: false,
});

const errors = ref({});

const loading = ref(false);
const options = ref([]);

const emit = defineEmits(["update:modelValue", "close"]);

onMounted(() => {
    if (route.params.id) {
        loading.value = true;
        store.dispatch("getUser", route.params.id).then((response) => {
            loading.value = false;
            user.value = response.data;
        });
    }
});

function onSubmit($event, close = false) {
    loading.value = true;
    errors.value = {};
    if (user.value.id) {
        store
            .dispatch("updateUser", user.value)
            .then((response) => {
                loading.value = false;
                if (response.status === 200) {
                    user.value = response.data;
                    store.dispatch("getUsers");
                    if (close) {
                        router.push({ name: "app.users" });
                    }
                }
            })
            .catch((err) => {
                loading.value = false;
                errors.value = err.response.data.errors;
            });
    } else {
        store
            .dispatch("createUser", user.value)
            .then((response) => {
                loading.value = false;
                if (response.status === 201) {
                    user.value = response.data;
                    store.dispatch("getUsers");
                    if (close) {
                        router.push({ name: "app.users" });
                    } else {
                        user.value = response.data;
                        router.push({
                            name: "app.users.view",
                            params: { id: response.data.id },
                        });
                    }
                }
            })
            .catch((err) => {
                loading.value = false;
                errors.value = err.response.data.errors;
            });
    }
}
</script>
