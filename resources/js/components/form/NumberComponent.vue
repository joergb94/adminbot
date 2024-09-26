<script setup>
import { ref, toRefs, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Number,
        default:0,
    },
    label: {
        type: String,
        default:'',
    },
});

const { modelValue } = toRefs(props);
const value = ref(modelValue.value);

watch(modelValue, (newVal) => {
    value.value = newVal;
});
</script>
<template>
    <div class="">
        <label class="text-xs text-600">{{ label }}</label>
        <div class="p-inputgroup flex-1">
            <div class="borderJustString flex-1">
                {{ value }}
            </div>
        </div>
    </div>
</template>

<style>
.borderJustString {
    font-weight: 600;
    border-bottom: thin solid #add1ed;
}
</style>
