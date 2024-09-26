<script setup>
import { toRefs, ref } from 'vue';
import ErrorMessageComponent from './ErrorMessageComponent.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Dropdown from 'primevue/dropdown';
import { computed } from 'vue';

const props = defineProps({
    modelValue: { type: Object, default: () => ({}) },
    required: { type: Boolean, required: false },
    filter: { type: Boolean, required: false },
    options: { type: Array, default: () => ([]) },
    optionLabel: { type: String, default: '' },
    icon: { type: String, default: '' },
    label: { type: String, default: '' },
    error: { type: String, default: '' },
    disabled: { type: Boolean, required: false },
});

const displaySize = ref(window.innerWidth);
const emit = defineEmits(['update:modelValue']);
const { modelValue, error } = toRefs(props);
const oldValue = ref(modelValue.value);
const mValue = computed({
    get: () => modelValue.value,
    set: (newMvalue) => {        
        emit('update:modelValue', newMvalue, oldValue.value);
        oldValue.value = newMvalue;
    },
});
</script>
<template>
    <div class="">
        <span v-if="required && label.length" class="pr-1 text-red-600">*</span>
        <label v-if="label.length" class="text-xs text-600">{{ label }}</label>
        <div class="p-inputgroup flex-1">
            <span class="p-inputgroup-addon">
                <FontAwesomeIcon :icon="icon" class="mr-1 text-primary-700" />
            </span>
            <Dropdown
                v-model="mValue"
                :options="options"
                :filter="filter"
                :optionLabel="optionLabel"
                :placeholder="label"
                class="font-bold"
                :class="{ 'p-invalid': error }"
                :disabled="disabled"
            >
                <template #option="slotProps">
                    <div class="font-bold">
                        {{ displaySize > 500  ? slotProps.option[`${optionLabel}`]: slotProps.option[`${optionLabel}`]?.substring(0, 27)+'...' }}
                    </div>
                </template>
                <template #value="slotProps">
                    <div class="font-bold" v-if="slotProps.value">
                        {{ slotProps.value[`${optionLabel}`] }}
                    </div>
                    <div class="placeholder" v-else>{{ slotProps.label }}</div>
                </template>
                <template #empty>
                    <div class="font-bold text-center">
                        <FontAwesomeIcon :icon="icon" class="mr-1 text-primary-700" /> No hay datos
                    </div>
                </template>
            </Dropdown>
        </div>
        <ErrorMessageComponent :message="error"></ErrorMessageComponent>
    </div>
   
</template>

<style>
.placeholder {
    color: #acb1b6;
    font-weight: normal;
}
.p-padding {
    font-size: 0.875rem;
    padding: 0.4375rem 0.4375rem;
}

@media (min-width: 391px) and (max-width: 500px) {
.p-inputgroup {
        height: auto;
        width:295px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 10px;
    }
}

@media (min-width: 365px)  and (max-width: 390px) {
.p-inputgroup {
        height: auto;
        width:265px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 10px;
    }
}

@media (min-width: 344px)  and (max-width: 364px) {
.p-inputgroup {
        height: auto;
        width:245px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 10px;
    }
}

</style>
