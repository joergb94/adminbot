<script setup>
const props = defineProps({
    icon: {
        type: String,
    },
    color: {
        type: String,
        default: '',
    },
    label: {
        type: String,
    },
    size: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <div>
        <i v-if="props.icon" :class="props.icon + ' ' + props.color + ' pr-1'" :style="{ fontSize: props.size }"></i>
        {{ props.label }}
    </div>
</template>
