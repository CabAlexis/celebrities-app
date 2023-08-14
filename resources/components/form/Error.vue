<template>
    <div class="text-sm text-red-400 p-1">{{ error }}</div>
</template>

<script setup>
const props = defineProps({
    error: {
        type: String,
        required: true,
    }
})

</script>