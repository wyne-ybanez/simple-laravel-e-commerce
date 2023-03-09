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
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-md text-left align-middle shadow-xl bg-green-100 transition-all"
            >
            <Spinner v-if="loading"
                       class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
            <header class="py-3 px-4 flex justify-between items-center">
                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                  {{ product.id ? `Update product: "${props.product.title}"` : 'Add Product' }}
                </DialogTitle>
                <button
                  @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
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
            <form @submit.prevent="onSubmit">
                <div class="bg-white px-4 pt-5 pb-4">
                    <CustomInput class="mb-2" v-model="product.title" label="Product Title"/>
                    <CustomInput type="file" class="mb-2" label="Product Image" @change="file => product.image = file"/>
                    <CustomInput class="mb-2" v-model="product.title" label="Product Title"/>
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

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
import { ref, computed, onUpdated } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import Spinner from '../../components/core/Spinner.vue';

const props = defineProps({
    modelValue: Boolean,
    product: {
        required: true,
        type: Object,
    }
})

const loading = ref(false)
const product = ref({
    id: props.product.id,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price,
})

const show = computed({
    get: () => props.modelValue, // we get this from Products.vue
    set: (value) => emit('update:modelValue', value)
})

onUpdated(() => {
    product.value = {
        id: props.product.id,
        title: props.product.title,
        image: props.product.image,
        description: props.product.description,
        price: props.product.price,
    }
})

const emit = defineEmits(['update:modelValue', 'close'])

function closeModal(){
  show.value = false
  emit('close')
}
</script>


<style scoped>

</style>
