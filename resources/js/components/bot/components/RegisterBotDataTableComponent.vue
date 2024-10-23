<script setup>
import { useStore } from 'vuex';
import { computed, ref, watch } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import LoadingComponent from '@/components/datatable/LoadingComponent.vue';
import NoFoundDataComponent from '@/components/datatable/NoFoundDataComponent.vue'
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
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

const tunrOnAndOffBot = (row) => {

    let header = row.active < 0?'El Bot se activara':'El Bot se deasactivara';
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:header,
        accept: () => {
            const params = row;
            const action = !!row.active? 'updateRegisterBotRequest' : 'storeRegisterBotRequest';
            dispatch(`${moduleName}/modalRequest`, { action, params: params, toast });
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
        <Column>
            <template #body="rowData">
                <Button v-if ="displaySize > 500" label="" icon="pi pi-pen-to-square" type="button" severity="success"  @click="selectBot(rowData)" class="mt-1 mb-1" />
                <!--<Button v-if ="displaySize > 500" label="" icon="pi pi-play" type="button" severity="success"  @click="tunrOnAndOffBot(rowData)" class="mt-1 mb-1" />
                    <Button v-if ="displaySize > 500" label="" icon="pi pi-stop" type="button" severity="danger"  @click="tunrOnAndOffBot(rowData)" class="mt-1 mb-1" />
                <Button  icon="pi pi-pen-to-square" type="button" severity="danger"  @click="selectBot(rowData)" class="mt-1 mb-1" />-->
            </template>
        </Column>
        <template #empty>
            <LoadingComponent v-if="showLoading" />
            <NoFoundDataComponent v-if="!showLoading" title="No hay Bots" />
        </template>
    </DataTable>
</template>
