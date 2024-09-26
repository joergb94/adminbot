<script setup>
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Boolean,
    },
});

const classStatus = computed(() => {
    return props.status ? 'success' : 'warning';
});

const iconStatus = computed(() => {
    return props.status ? 'pi pi-check' : 'pi pi-times';
});

const status = computed(() => {
    return props.status ? 'Si' : 'No';
});
</script>

<template>
    <Tag :severity="classStatus" :value="status" :icon="iconStatus"></Tag>
</template>
