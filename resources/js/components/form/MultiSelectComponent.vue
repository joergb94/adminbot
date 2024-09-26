<script setup>
import { toRefs } from 'vue';
import ErrorMessageComponent from './ErrorMessageComponent.vue';
import { computed } from 'vue';
import MultiSelect from 'primevue/multiselect';

const props = defineProps({
    modelValue: { type: String, required: true },
    required: { type: Boolean, required: false },
    filter: { type: Boolean, required: false },
    options: { type: String, default: '' },
    optionLabel: { type: String, default: '' },
    icon: { type: String, default: '' },
    label: { type: String, default: '' },
    error: { type: String, default: '' },
    showToggleAll: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    maxSelectedLabels: { type: Number, default: 3 },
    selectionLimit: { type: Number, default: 5 },
});

const emit = defineEmits(['update:modelValue']);
const { modelValue, error } = toRefs(props);

const mValue = computed({
    get: () => modelValue.value,
    set: (newMvalue) => emit('update:modelValue', newMvalue),
});
</script>
<template>
    <span v-if="required && label.length" class="pr-1 text-red-600">*</span>
    <label v-if="label.length" class="text-xs text-600">{{ label }}</label>
    <div class="p-inputgroup flex-1">
        <span class="p-inputgroup-addon">
            <FontAwesomeIcon :icon="icon" class="mr-1 text-primary-700" />
        </span>
        <MultiSelect
            v-model="mValue"
            :options="options"
            :showToggleAll="showToggleAll"
            :filter="filter"
            :optionLabel="optionLabel"
            :placeholder="label"
            :class="{ 'p-invalid': error }"
            :maxSelectedLabels="maxSelectedLabels"
            :loading="loading"
            class="w-full md:w-20rem"
            :selectionLimit="selectionLimit"
            display="chip"
        >
            <template #option="slotProps">
                <div class="p-inputtext-sm font-bold">
                    {{ slotProps.option[`${optionLabel}`] }}
                </div>
            </template>
        </MultiSelect>
    </div>
    <ErrorMessageComponent :message="error"></ErrorMessageComponent>
</template>

<style>
.placeholder {
    color: #acb1b6;
    font-weight: normal;
}
</style>
