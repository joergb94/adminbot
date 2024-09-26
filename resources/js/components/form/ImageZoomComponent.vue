<script setup>
import { computed } from 'vue';
import Image from 'primevue/image';

    const props = defineProps({
        url: {
            type: String,
        },
    });
    const url = computed(() => props.url);
</script>
<template> 
    <Image alt="Image" preview>
        <template #indicatoricon>
            <i class="pi pi-search"></i>
        </template>
        <template #image>
            <img :src="url" class="mt-2" alt="Image" width="100%" />
        </template>
        <template #preview="slotProps">
            <img :src="url" alt="preview" :style="slotProps.style" @click="slotProps.onClick" />
        </template>
    </Image>
</template>
