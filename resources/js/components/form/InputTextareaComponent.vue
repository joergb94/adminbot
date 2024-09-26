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
    error: String,
    label: String,
    readOnly: {
        type: Boolean,
        default: false,
    },
    showOnlyValue: {
        type: Boolean,
        default: false,
    },
});

const { modelValue, error } = toRefs(props);

const value = ref(modelValue.value);

watch(modelValue, (newVal) => {
    value.value = newVal;
});

const emit = defineEmits(['update:modelValue']);

const handleInput = (newVal) => {
    emit('update:modelValue', newVal.target.value);
};
</script>
<template>
    <div v-if="showOnlyValue">
        <label class="text-xs text-600">{{ label }}</label>
        <div class="p-inputgroup flex-1">
            <div class="borderJustString flex-1">
                {{ value || '.' }}
            </div>
        </div>
    </div>
    <div v-else>
        <span v-if="required" class="pr-1 text-red-600">*</span>
        <label class="text-xs text-600">{{ label }}</label>
        <div class="p-inputgroup flex-1">
            <Textarea
                @input="handleInput"
                v-model="value"
                class="p-inputtext-sm sm:col-12 md:col- lg:col-12 xl:col-12"
                :placeholder="label"
                :readOnly="readOnly"
                :class="{ 'p-invalid': error }"
                rows="5"
                cols="30"
            >
                {{ value }}
            </Textarea>
        </div>
    </div>
    <ErrorMessageComponent :message="error"></ErrorMessageComponent>
</template>

<style lang="postcss">
input::placeholder {
    color: #acb1b6;
    font-weight: normal;
}
</style>
