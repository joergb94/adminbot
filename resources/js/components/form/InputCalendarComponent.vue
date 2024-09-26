<script setup>
import { ref, toRefs } from 'vue';
import { watch } from 'vue';
import ErrorMessageComponent from './ErrorMessageComponent.vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    required: {
        type: Boolean,
        required: false,
    },
    icon: String,
    placeholder: String,
    dateFormat: String,
    error: String,
    label: String,
    readOnly: {
        type: Boolean,
        default: false,
    },
});

const { modelValue, error } = toRefs(props);

const value = ref(modelValue.value);

const emit = defineEmits(['update:modelValue']);
watch(value, (newVal) => {
    emit('update:modelValue', newVal);
});
</script>
<template>
    <span v-if="required" class="pr-1 text-red-600">*</span>
    <label class="text-xs text-600">{{ label }}</label>
    <div class="p-inputgroup flex-1">
        <span class="p-inputgroup-addon">
            <FontAwesomeIcon :icon="icon" class="mr-1 text-primary-700" />
        </span>
        <Calendar dateFormat="yy-mm-dd" v-model="value" :placeholder="placeholder" />
    </div>
    <ErrorMessageComponent :message="error"></ErrorMessageComponent>
</template>

<style lang="postcss">
input::placeholder {
    color: #acb1b6;
    font-weight: normal;
}
</style>
