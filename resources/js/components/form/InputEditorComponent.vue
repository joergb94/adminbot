<script setup>
import { ref, toRefs } from 'vue';
import { watch } from 'vue';
import ErrorMessageComponent from './ErrorMessageComponent.vue';
import Editor from 'primevue/editor';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    required: {
        type: Boolean,
        required: false,
    },
    error: String,
    label: String,
    description: String,
    readonly: {
        type: Boolean,
        default: false,
    },
    editorStyleValue: {
        type: String,
        default: '150px',
    },
    showOnlyValue: {
        type: Boolean,
        default: false,
    },
});

const { modelValue, error } = toRefs(props);

const value = ref(modelValue.value);
const editorStyle = `height:${props.editorStyleValue}`;

watch(modelValue, (newVal) => {
    value.value = newVal;
});

const emit = defineEmits(['update:modelValue']);
watch(value, (newVal) => {
    emit('update:modelValue', newVal);
});
</script>
<template>
    <div v-if="showOnlyValue">
        <label class="text-xs text-600">{{ label }}</label>
        <div class="p-inputgroup flex-1">
            <div class="borderJustString flex-1">
                {{ description || '.' }}
            </div>
        </div>
    </div>
    <div v-else>
        <Card class="mb-2">
            <template #title>
                <div class="text-xl font-bold">{{ label }}</div>
            </template>
            <template #subtitle>
                <div class="text-base mb-3" v-if="description">
                    <FontAwesomeIcon icon="fa-solid fa-circle-info" class="mr-1 text-primary-700" />
                    <span v-if="required" class="pr-1 text-red-600">* </span>
                    {{ description }}
                </div>
            </template>
            <template #content>
                <div class="grid -mt-3">
                    <Editor
                        class="p-inputtext-sm sm:col-12 md:col- lg:col-12 xl:col-12"
                        :class="{ 'p-invalid': error }"
                        v-model="value"
                        :editorStyle="editorStyle"
                        :readonly="readonly"
                    />
                    <ErrorMessageComponent :message="error"></ErrorMessageComponent>
                </div>
            </template>
        </Card>
    </div>
</template>

<style lang="postcss">
input::placeholder {
    color: #acb1b6;
    font-weight: normal;
}
</style>
