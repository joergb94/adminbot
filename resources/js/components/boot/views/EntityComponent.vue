<script setup>
import { useStore } from 'vuex';
import { computed, onMounted, watch } from 'vue';
import EntityDataTableComponent from '../components/RegisterEntityDataTableComponent.vue';
import EntityToolbarComponent from '../components/RegisterEntityToolbarComponent.vue';
import Dialog from 'primevue/dialog';
import EntityForm from './RegisterEntityForm.vue';

import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const dispatch = useStore().dispatch;
const getters = useStore().getters;

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();

const moduleName = 'registerEntity';
const title = getters[`${moduleName}/getTitle`];
const subTitle = getters[`${moduleName}/getSubTitle`];
const breadcrumb = getters[`${moduleName}/getBreadcrumb`];
const props = defineProps({
    registers: {
        type: String
    },
}); 
const records = computed(() => getters[`${moduleName}/getRegisterEntityAll`]);

const showModalForm = computed({
    get: () => getters[`${moduleName}/getShowModalForm`],
    set: (show) => dispatch(`${moduleName}/showModalFormState`, show),
});

const showModalFormHandler = (show) => {
    showModalForm.value = show;
};



onMounted(() => {
    dispatch(`${moduleName}/moduleRequest`, { action: 'findRegisterEntityAllBladeRequest', params: JSON.parse(props.registers), toast });
});
</script>

<template>
        <Toast />
        <ConfirmDialog class="sm:col-12 lg:col-4 xl:col-4"></ConfirmDialog>
        <Card class="col-12">
            <template #title>
                <h2><fontAwesomeIcon icon="fa fa-address-book" class="mr-1 text-primary-700" /> {{ title }} </h2>
            </template>
            <template #content>
                <EntityToolbarComponent :result="records.length" />
                <EntityDataTableComponent :registers="records" />
            </template>
        </Card>
            <Dialog v-model:visible="showModalForm" modal :style="{ width: '85rem' }">
                <template #header>
                    <div class="text-2xl font-bold">{{ title }}</div>
                </template>
                <EntityForm />
                <template #footer>
                    <prime-button label="Cerrar" icon="pi pi-times" @click="showModalFormHandler(false)" class="mt-3" severity="secondary" />
                    <prime-button label="Guardar" icon="pi pi-check" form="frmEntity" type="submit" severity="success" class="mt-3" />
                </template>
            </Dialog>
</template>
