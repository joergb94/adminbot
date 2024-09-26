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
    rfc: { value: '', matchMode: FilterMatchMode.CONTAINS },
    business_name: { value: '', matchMode: FilterMatchMode.CONTAINS },
    email: { value: '', matchMode: FilterMatchMode.CONTAINS },
    first_phone: { value: '', matchMode: FilterMatchMode.CONTAINS },
    second_phone: { value: '', matchMode: FilterMatchMode.CONTAINS },
});
const moduleName = 'registerEntity';
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

const selectEntity = (row) => {
    const params = { id: row.data.id };
    dispatch(`${moduleName}/moduleRequest`, { action: 'findRegisterEntityByIdRequest', params, toast });
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
        <Column field="rfc" header="RFC" :showFilterMenu="false" :sortable="true">
            <template #body="slotProps">
                <div>
                    <h6>{{ slotProps.data.rfc }}</h6>
                    <p v-if ="displaySize < 500">{{ slotProps.data.business_name }}</p>
                </div>
            </template>
            <template #filter="{ filterModel, filterCallback }">
                <InputText
                    v-model="filterModel.value"
                    type="text"
                    @input="filterCallback()"
                    class="p-column-filter p-inputtext-sm"
                    placeholder="Buscar por RFC"
                />
            </template>
        </Column>
        <Column v-if ="displaySize > 500" field="business_name" header="Nombre de la Empresa" :showFilterMenu="false" :sortable="true">
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
        <Column v-if ="displaySize > 500" field="email" header="Correo Electronico" :showFilterMenu="false" :sortable="true">
            <template #filter="{ filterModel, filterCallback }">
                <InputText
                    v-model="filterModel.value"
                    type="text"
                    @input="filterCallback()"
                    class="p-column-filter p-inputtext-sm"
                    placeholder="Buscar por correo electronico"
                />
            </template>
        </Column>
        <Column>
            <template #body="rowData">
                <Button v-if ="displaySize > 500" label="Editar" icon="pi pi-pen-to-square" type="button" severity="success"  @click="selectEntity(rowData)" class="mt-1 mb-1" />
                <Button v-else icon="pi pi-pen-to-square" type="button" severity="success"  @click="selectEntity(rowData)" class="mt-1 mb-1" />
            </template>
        </Column>
        <template #empty>
            <LoadingComponent v-if="showLoading" />
            <NoFoundDataComponent v-if="!showLoading" title="No hay Empresas" />
        </template>
    </DataTable>
</template>
