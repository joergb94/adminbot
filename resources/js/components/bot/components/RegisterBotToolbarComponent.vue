<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    result: {
        type: Number,
    },
});

const store = useStore();
const moduleName = 'storeBot';
const result = computed(() => props.result);

const showModalFormHandler = (show) => {
    store.dispatch(`${moduleName}/showModalFormState`, show);
    store.dispatch(`${moduleName}/resetRegisterBotState`);
};

</script>
<template>
    <Toolbar>
        <template #start>
            <div><fontAwesomeIcon :icon="['fass', 'list']" class="mr-2 ml-1 text-primary-700" />Resultados: {{ result }}</div>
        </template>
        <template #end>
            <Button icon="pi pi-plus" class="mr-2" label="Agregar" @click="showModalFormHandler(true)" />
        </template>
    </Toolbar>
</template>
