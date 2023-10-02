<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="w-full max-w-7xl h-[80ch] transform overflow-x-hidden rounded-sm text-left align-middle shadow-lg transition-all">
                            <Spinner
                                v-if="loading"
                                class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"
                            />
                            <header class="py-3 px-4 flex justify-between items-center bg-zinc-200 sticky top-0">
                                <DialogTitle
                                    as="h3"
                                    class="text-base leading-6 font-medium text-gray-900"
                                >
                                    {{
                                        user.id
                                            ? `Update User: ${props.user.title}`
                                            : "Add User"
                                    }}
                                </DialogTitle>
                                <button
                                    @click="closeModal()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer text-zinc-400 hover:text-black"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit" enctype="multipart/form-data">
                                <div class="bg-white px-4 pt-1 pb-4">
                                    <CustomInput
                                        class="mb-2"
                                        v-model="user.title"
                                        label="User Title"
                                    />
                                     <CustomInput
                                        class="mb-2"
                                        v-model="user.category"
                                        label="Category"
                                    />
                                    <CustomInput
                                        type="textarea"
                                        class="mb-2"
                                        v-model="user.description"
                                        label="Description"
                                    />
                                    <CustomInput
                                        type="textarea"
                                        class="mb-2"
                                        v-model="user.description_2"
                                        label="Alternative Description"
                                    />
                                    <CustomInput
                                        type="number"
                                        class="mb-2"
                                        v-model="user.price"
                                        label="Price"
                                        prepend="€"
                                    />
                                    <CustomInput
                                        type="checkbox"
                                        class="mb-2"
                                        v-model="user.color"
                                        label="Colored Image"
                                    />
                                </div>
                                <footer class="bg-white px-4 py-6 sm:flex sm:flex-row-reverse justify-between border border-t-1 border-r-0 border-stone-200 sticky bottom-0">
                                    <button
                                        type="submit"
                                        class="mt-5 inline-flex justify-center rounded-sm shadow-sm px-8 py-2 bg-green-600 md:text-base font-light text-white hover:bg-green-700 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-base"
                                    >
                                        Submit
                                    </button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, computed, onUpdated } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import Spinner from "../../components/core/Spinner.vue";
import store from "../../store";
import CustomInput from "../../components/core/CustomInput.vue";

const props = defineProps({
    modelValue: Boolean,
    user: {
        required: true,
        type: Object,
    },
});

const loading = ref(false);
const user = ref({
    id: props.user.id,
    title: props.user.title,
    image: props.user.image,
    image_1: props.user.image_1,
    image_2: props.user.image_2,
    image_3: props.user.image_3,
    category: props.user.category,
    description: props.user.description,
    description_2: props.user.description_2,
    price: props.user.price,
    color: props.user.color,
});

// changes what appears on modal when opening modal again
const show = computed({
    get: () => props.modelValue, // we get this from Users.vue
    set: (value) => emit("update:modelValue", value),
});

onUpdated(() => {
    user.value = {
        id: props.user.id,
        title: props.user.title,
        image: props.user.image,
        image_1: props.user.image_1,
        image_2: props.user.image_2,
        image_3: props.user.image_3,
        category: props.user.category,
        description: props.user.description,
        description_2: props.user.description_2,
        price: props.user.price,
        color: props.user.color,
    };
});

const emit = defineEmits(["update:modelValue", "close"]);

function closeModal() {
    show.value = false;
    emit("close");
}

function onSubmit() {
  loading.value = true
  if (user.value.id) {
    store.dispatch('updateUser', user.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          // TODO show notification if: user updated
          store.dispatch('getUsers')
          closeModal()
        }
      })
  }
  else {
    store.dispatch('createUser', user.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          // TODO show notification if: user created
          store.dispatch('getUsers')
          closeModal()
        }
      })
  }
}
</script>

<style scoped></style>
