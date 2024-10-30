<script setup>
import { useStore } from 'vuex';
import { computed, ref, watch } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import LoadingComponent from '@/components/datatable/LoadingComponent.vue';
import NoFoundDataComponent from '@/components/datatable/NoFoundDataComponent.vue'
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import SpeedDial from 'primevue/speeddial';
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();

const props = defineProps({
    registers: {
        type: Array,
        required: true,
    },
});
const displaySize = ref(window.innerWidth);
const registers = computed(() => props.registers);
const filters = ref({
    name: { value: '', matchMode: FilterMatchMode.CONTAINS },
    telegram_bot: { value: '', matchMode: FilterMatchMode.CONTAINS },
    whatsapp_number: { value: '', matchMode: FilterMatchMode.CONTAINS },
});
const moduleName = 'storeBot';
const menu = ref();
//check the value of progressbar and set on that
const showLoading = ref(false);
const dispatch = useStore().dispatch;
const getters = useStore().getters;
watch(
    () => getters[`${moduleName}/getShowLoading`],
    (show) => {
        showLoading.value = show;
    }
);

const selectBot = (row) => {
    const params = { id: row.data.id };
    dispatch(`${moduleName}/moduleRequest`, { action: 'findRegisterBotByIdRequest', params, toast });
};

const showBot = (row) => {
    const params = { id: row.data.id };
    dispatch(`${moduleName}/moduleRequest`, { action: 'findRegisterBotByIdDetailRequest', params, toast });
};

const tunrOnAndOffBot = (row) => {

    let header = row.data.active == 0?'El Bot se activara':'El Bot se deasactivara';
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:header,
        accept: () => {
            console.log(row.data.active)
            const params = { id: row.data.id , active:row.data.active };
            dispatch(`${moduleName}/moduleRequest`, { action: 'turnOnOrOffRegisterBotRequest', params, toast });
        }, 
    });
    
};

const deleteBot = (row) => {

    let header = row.data.active == 0?'El Bot se activara':'El Bot se deasactivara';
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:header,
        accept: () => {
            console.log(row.data.active)
            const params = { id: row.data.id };
            dispatch(`${moduleName}/moduleRequest`, { action: 'deleteRegisterBotRequest', params, toast });
        }, 
    });

};


</script>

<template>
    <DataTable 
        :value="registers"
        class="p-datatable-sm col-12"
        :paginator="true"
        :rows="100"
        size="large"
        filterDisplay="row"
        v-model:filters="filters"
        :scrollable="true"
        scrollHeight="calc(100vh - 300px)"
        stripedRows
    >
        <Column v-if ="displaySize > 500" header="No">
            <template #body="rowData">
                {{ rowData.index + 1 }}
                
            </template>
        </Column>
        <Column field="name" header="Nombre" :showFilterMenu="false" :sortable="true">
            <template #body="slotProps">
                <div>
                    <h6>{{ slotProps.data.name}}</h6>
                </div>
            </template>
            <template #filter="{ filterModel, filterCallback }">
                <InputText
                    v-model="filterModel.value"
                    type="text"
                    @input="filterCallback()"
                    class="p-column-filter p-inputtext-sm"
                    placeholder="Buscar por Nombre"
                />
            </template>
        </Column>
        <Column v-if ="displaySize > 500" field="telegram_bot" header="telegram" :showFilterMenu="false" :sortable="true">
            <template #filter="{ filterModel, filterCallback }">
                <InputText
                    v-model="filterModel.value"
                    type="text"
                    @input="filterCallback()"
                    class="p-column-filter p-inputtext-sm"
                    placeholder="Buscar por bot de telegram"
                />
            </template>
        </Column>
        <Column v-if ="displaySize > 500" field="whatsapp_number" header="whatsApp" :showFilterMenu="false" :sortable="true">
            <template #filter="{ filterModel, filterCallback }">
                <InputText
                    v-model="filterModel.value"
                    type="text"
                    @input="filterCallback()"
                    class="p-column-filter p-inputtext-sm"
                    placeholder="Buscar por whatsApp"
                />
            </template>
        </Column>
        <Column header="opciones">
            <template #body="rowData">
                <Button v-if ="displaySize > 500" label="" icon="pi pi-pen-to-square" type="button" severity="success"  @click="selectBot(rowData)" class="mt-1 mb-1 ml-1" />
                <Button v-if ="displaySize > 500" label="" icon="pi pi-eye" type="button" class="button-flexbetta-green mt-1 mb-1 ml-1" @click="showBot(rowData)"/>
                <Button v-if ="displaySize > 500 && !rowData.data.active" label="" icon="pi pi-play" type="button" severity="success"  @click="tunrOnAndOffBot(rowData)" class="mt-1 mb-1 ml-1" />
                <Button v-if ="displaySize > 500 &&  rowData.data.active" label="" icon="pi pi-stop" type="button" severity="danger"  @click="tunrOnAndOffBot(rowData)" class="mt-1 mb-1 ml-1" />
                <Button  icon="pi pi-trash" type="button" severity="danger"  @click="deleteBot(rowData)" class="mt-1 mb-1 ml-1" />
            </template>
            
        </Column>
        <template #empty>
            <LoadingComponent v-if="showLoading" />
            <NoFoundDataComponent v-if="!showLoading" title="No hay Bots" />
        </template>
    </DataTable>
</template>
