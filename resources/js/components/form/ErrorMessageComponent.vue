<script setup>
import { computed } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faXmarkCircle } from '@fortawesome/free-solid-svg-icons';

library.add(faXmarkCircle);

const props = defineProps({
    message: {
        type: String,
    },
});
const message = computed(() => props.message);
</script>
<template>
    <div v-if="message">
        <FontAwesomeIcon :icon="['fas', 'xmark-circle']" class="ml-1 mr-2 text-red-600" /><small class="text-red-500">{{ message }}</small>
    </div>
</template>
