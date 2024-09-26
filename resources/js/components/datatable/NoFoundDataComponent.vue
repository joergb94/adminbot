<script setup>
const props = defineProps({
    title: {
        type: String,
        default: 'Data not found',
    },
});
</script>
<template>
    <Card class="card flex justify-content-center">
        <template #subtitle>{{ title }}</template>
    </Card>
</template>
