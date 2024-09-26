<script setup>
import { ref, toRefs } from 'vue';
import { watch } from 'vue';
import ToggleButton from 'primevue/togglebutton';

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    disabled: {
        type: Boolean,
        required: true,
    },
    label: String,
    onLabel: {
        type: String,
        default: 'Si',
    },
    offLabel: {
        type: String,
        default: 'No',
    },
});

const { modelValue } = toRefs(props);

const value = ref(modelValue.value);

watch(modelValue, (newVal) => {
    value.value = newVal;
});

const emit = defineEmits(['update:modelValue']);

watch(value, (newVal) => {
    emit('update:modelValue', newVal);
});
</script>
<template>
    <div class="field-checkbo p-2">
        <label for="city1">{{ label }}</label>
    </div>
    <div class="p-inputgroup flex-1">
        <ToggleButton
            v-model="value"
            :onLabel="onLabel"
            :offLabel="offLabel"
            :disabled="disabled"
            onIcon="pi pi-check"
            offIcon="pi pi-times"
            class="w-9rem"
        />
    </div>
</template>
