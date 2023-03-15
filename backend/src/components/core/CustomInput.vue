<template>
     <div>
    <label class="sr-only">{{ label }}</label>
    <div class="mt-8 flex rounded-sm shadow-sm">
      <span v-if="prepend"
            class="inline-flex items-center mt-8 px-3 h-12 rounded-l-sm border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        {{ prepend }}
      </span>
      <template v-if="type === 'select'">
         <div class="absolute">
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
      </template>
      <template v-else-if="type === 'textarea'">
        <div class="absolute">
            {{ label }}
            <span v-if="required" class="text-zinc-400 text-lg">*</span>
        </div>
        <textarea :name="name"
                    :required="required"
                    :value="props.modelValue"
                    @input="emit('update:modelValue', $event.target.value)"
                    :class="inputClasses">
        </textarea>
      </template>
      <template v-else-if="type === 'file'">
        <div class="absolute">
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
      </template>
      <template v-else-if="type === 'checkbox'">
        <div class="absolute">
            {{ label }}
            <span v-if="required" class="text-zinc-400 text-lg">*</span>
        </div>
        <input :id="id"
               :name="name"
               :type="type"
               :checked="props.modelValue"
               :required="required"
               @change="emit('update:modelValue', $event.target.checked)"
               class="h-4 w-4 text-zinc-600 border-gray-300 rounded"/>
        <label :for="id" class="ml-2 block text-sm text-gray-900"> {{ label }} </label>
      </template>
      <template v-else>
        <div class="absolute">
            {{ label }}
            <span class="text-zinc-400 text-lg">*</span>
        </div>
        <input :type="type"
               :name="name"
               :required="required"
               :value="props.modelValue"
               @input="emit('update:modelValue', $event.target.value)"
               :class="inputClasses"
               step="0.01"/>
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
        `block w-full mt-8 px-3 py-3 border border-gray-300 bg-zinc-50 placeholder-gray-500 text-zinc-900 focus:border-gray-400 focus:bg-white focus:outline-none focus:ring-0 focus:ring-offset-0 sm:text-sm`,
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