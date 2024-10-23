<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    result: {
        type: Number,
    },
});
const getters = useStore().getters;
const store = useStore();
const moduleName = 'storeBot';
const title = getters[`${moduleName}/getTitle`];
const icon = getters[`${moduleName}/getIcon`];
const result = computed(() => props.result);

const showModalFormHandler = (show) => {
    store.dispatch(`${moduleName}/showModalFormState`, show);
    store.dispatch(`${moduleName}/resetRegisterBotState`);
};

</script>
<template>
    <Toolbar class="boder-green-flex">
        <template #start>
            <fontAwesomeIcon :icon="['fass', 'list']" class="mr-2 ml-1 neo-text-green" />Resultados: {{ result }}
        </template>
        <template #end>
            <Button icon="pi pi-plus" class="button-flexbetta-green mr-2" label="Agregar" @click="showModalFormHandler(true)" />
        </template>
    </Toolbar>
</template>
