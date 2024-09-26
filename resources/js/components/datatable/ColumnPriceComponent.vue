<script setup>
import { computed } from 'vue';
import { number } from 'yup';

const props = defineProps({
    price: {
        type: Number,
        default: 0,
    },
});

const price = computed(() => {
    const formattedPrice = props.price ? new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).formatToParts(props.price) : '-';
    if (formattedPrice !== '-') {
        formattedPrice.splice(1, 0, { type: 'literal', value: ' ' });
        return formattedPrice.map((part) => part.value).join('');
    }
    return formattedPrice;
});
</script>

<template>
    {{ price }}
</template>
