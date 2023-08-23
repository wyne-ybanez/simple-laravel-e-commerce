<template>
  <div>
    <label class="sr-only">{{ label }}</label>
    <div class="mt-8 flex rounded-sm shadow-sm">
      <!-- <span v-if="prepend"
            class="inline-flex items-center px-3 rounded-l-sm border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        {{ prepend }}
      </span> -->
      <template v-if="type === 'select'">
       <div class="flex flex-col grow">
            <div>
                {{ label }}
                <span v-if="required" class="text-zinc-400 text-lg">*</span>
            </div>
            <select :name="name"
                    :required="required"
                    :value="props.modelValue"
                    :class="inputClasses"
                    @change="onChange($event.target.value)">
            <option v-for="option of selectOptions" :value="option.key">{{option.text}}</option>
            </select>
        </div>
      </template>
      <template v-else-if="type === 'textarea'">
        <div class="flex flex-col grow">
            <div>
                {{ label }}
                <span v-if="required" class="text-zinc-400 text-lg">*</span>
            </div>
            <textarea :name="name"
                        :required="required"
                        :value="props.modelValue"
                        @input="emit('update:modelValue', $event.target.value)"
                        :class="inputClasses">
            </textarea>
        </div>
      </template>
      <template v-else-if="type === 'file'">
        <div class="flex flex-col grow">
            <div>
                {{ label }}
                <span v-if="required" class="text-zinc-400 text-lg">*</span>
            </div>
            <input :type="type"
                :name="name"
                :required="required"
                :value="props.modelValue"
                @input="emit('change', $event.target.files[0])"
                :class="inputClasses"
                :placeholder="label"/>
        </div>
      </template>
      <template v-else-if="type === 'checkbox'">
        <div class="flex flex-col grow">
            <label class="block text-sm mb-2 text-zinc-400"> Product images are black & white by default </label>
            <div>
                {{ label }}
                <span v-if="required" class="text-zinc-400 text-lg">*</span>
                <input
                    :name="name"
                    :type="type"
                    :checked="props.modelValue"
                    :required="required"
                    @change="emit('update:modelValue', $event.target.checked)"
                    class="h-[20px] w-[20px] text-zinc-600 border-gray-200 ml-1 accent-green-500 mb-5"
                />
            </div>
        </div>
      </template>
      <template v-else>
        <div class="flex flex-col grow">
            <div>
                {{ label }}
                <span class="text-zinc-400 text-lg">*</span>
            </div>
            <input v-if="label === 'Price' "
                placeholder="€"
                :type="type"
                :name="name"
                :required="required"
                :value="props.modelValue"
                @input="emit('update:modelValue', $event.target.value)"
                :class="inputClasses"
                step="0.01"/>
            <input v-else
                :type="type"
                :name="name"
                :required="required"
                :value="props.modelValue"
                @input="emit('update:modelValue', $event.target.value)"
                :class="inputClasses"/>
        </div>
      </template>
      <span v-if="append"
            class="inline-flex items-center px-3 rounded-r-sm border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        {{ append }}
      </span>
    </div>
  </div>
</template>

<script setup>

import {computed} from "vue";

const props = defineProps({
    modelValue: [String, Number, File],
    label: String,
    type: {
        type: String,
        default: 'text',
    },
    name: String,
    required: Boolean,
    prepend: {
        type: String,
        default: '',
    },
    append: {
        type: String,
        default: '',
    },
    selectOptions: Array
})

const inputClasses = computed(() => {
    const cls = [
        `w-full mt-3 px-3 py-3 border border-gray-300 bg-zinc-50 placeholder-gray-500 text-zinc-900 focus:border-gray-400 focus:bg-white focus:outline-none focus:ring-0 focus:ring-offset-0 sm:text-sm`,
    ];

    if (props.append && !props.prepend) {
        cls.push(`rounded-l-sm`)
    }
    if (props.prepend && !props.append) {
        cls.push(`rounded-r-sm`)
    }
    if (!props.prepend && !props.append) {
        cls.push(`rounded-sm`)
    }
    return cls.join(' ')
})

const emit = defineEmits(['update:modelValue', 'change'])

</script>

<style scoped>
</style>