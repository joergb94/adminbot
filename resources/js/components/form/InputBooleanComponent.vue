<script setup>
import { ref, toRefs } from 'vue';
import { watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    label: String,
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
        <Checkbox id="binary" v-model="value" :binary="true" class="pr-1" />
        <label for="city1">{{ label }}</label>
    </div>
</template>
