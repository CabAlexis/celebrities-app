<template>
  <div class="mb-4">
    <label class="block mb-2" :for="forAndId">{{ label }}</label>
    <textarea v-if="type === 'textarea'" :value="modelValue" :id="forAndId" :class="inputClass" @input="handleInput"></textarea>
    <input v-else-if="type === 'file'" :id="forAndId" type="file" accept="image/*" :class="inputClass"
      @change="handleFileChange" />
    <input v-else :value="modelValue" :id="forAndId" :type="type" :class="inputClass" @input="handleInput" />
  </div>
</template>
  
<script setup>
import { defineProps, defineEmits, computed } from 'vue';

const props = defineProps({
  label: {
    type: String,
    required: false,
    default: null,
  },
  forAndId: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    required: true,
  },
  modelValue: {
    type: String,
  },
});

const emits = defineEmits(['update:modelValue', 'fileChanged']);


const inputClass = computed(() => {
  let classList = 'w-full p-2 border border-gray-300 rounded';

  if (props.type === 'textarea') {
    classList += ' h-32';
  }

  return classList;
});

const handleInput = (event) => {
  emits('update:modelValue', event.target.value);
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  emits('fileChanged', file);
};
</script>
