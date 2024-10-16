<script setup>
import { useStore } from 'vuex';
import { computed, onMounted, watch } from 'vue';
import BotDataTableComponent from '../components/RegisterBotDataTableComponent.vue';
import BotToolbarComponent from '../components/RegisterBotToolbarComponent.vue';
import Dialog from 'primevue/dialog';
import BotForm from './RegisterBotForm.vue';

import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const dispatch = useStore().dispatch;
const getters = useStore().getters;

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();

const moduleName = 'storeBot';
const title = getters[`${moduleName}/getTitle`];
const subTitle = getters[`${moduleName}/getSubTitle`];
const breadcrumb = getters[`${moduleName}/getBreadcrumb`];
const props = defineProps({
    registers: {
        type: String
    },
}); 
const records = computed(() => getters[`${moduleName}/getRegisterBotAll`]);

const showModalForm = computed({
    get: () => getters[`${moduleName}/getShowModalForm`],
    set: (show) => dispatch(`${moduleName}/showModalFormState`, show),
});

const showModalFormHandler = (show) => {
    showModalForm.value = show;
};



onMounted(() => {
    dispatch(`${moduleName}/moduleRequest`, { action: 'findRegisterBotAllBladeRequest', params: JSON.parse(props.registers), toast });
});
</script>

<template>
        <Toast />
        <ConfirmDialog class="sm:col-12 lg:col-4 xl:col-4"></ConfirmDialog>
        <Card class="col-12">
            <template #title>
                <h2 class="text-left" ><fontAwesomeIcon icon="fa fa-address-book" class="mr-1 text-primary-700" /> {{ title }} </h2>
            </template>
            <template #content>
                <BotToolbarComponent :result="records? records.length: 0" />
                <BotDataTableComponent :registers="records" />
            </template>
        </Card>
            <Dialog v-model:visible="showModalForm" modal :style="{ width: '85rem' }">
                <template #header>
                    <div class="text-2xl font-bold">{{ title }}</div>
                </template>
                <BotForm />
                <template #footer>
                    <prime-button label="Cerrar" icon="pi pi-times" @click="showModalFormHandler(false)" class="mt-3" severity="secondary" />
                    <prime-button label="Guardar" icon="pi pi-check" form="frmBot" type="submit" severity="success" class="mt-3" />
                </template>
            </Dialog>
</template>
