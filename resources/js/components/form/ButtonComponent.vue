<script setup>
const props = defineProps({
    severity: {
        type: String,
        default: 'success',
    },
    label: {
        type: String,
        default: 'button',
    },
    icon: {
        type: String,
        default: 'fa-solid fa-xmark',
    },
    class: {
        type: String,
        default: '',
    },
    click: {
        type: Function,
        default: () => {},
    },
    form: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'button',
    },

});
</script>
<template>
    <Button @click="click" :class="class" size="small" :severity="severity" :form="form" type="type" raised>
        <font-awesome-icon :icon="icon" class="pr-1" /> {{ label }}
    </Button>
</template>
