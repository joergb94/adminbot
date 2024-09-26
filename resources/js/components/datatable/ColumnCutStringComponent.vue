<script setup>
import { computed } from 'vue';

const props = defineProps({
    data: {
        type: String,
    },
    max: {
        type: Number,
        default: 50,
    },
});

const data = computed(() => {
    const str = props.data;
    return str.length >= props.max ? str.slice(0, props.max) + ' ...' : str;
});
</script>

<template>
    {{ data }}
</template>
