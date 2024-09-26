<script setup>
import { computed } from 'vue';
import { number } from 'yup';

const props = defineProps({
    value: {
        type: number,
        default: 0,
    },
});

const value = computed(() => {
    return Math.floor(props.value).toLocaleString('es-MX');
});
</script>

<template>
    {{ value }}
</template>
