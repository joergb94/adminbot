<script setup>
import { useStore } from 'vuex';
import { computed, ref, onMounted } from 'vue';
import OrganizationChart from 'primevue/organizationchart';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import NoFoundDataComponent from '@/components/datatable/NoFoundDataComponent.vue'
import DataView from 'primevue/dataview';
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();
// ------- Common variables
const moduleName = 'storeBot';


// ------- useStore
const getters = useStore().getters;
const dispatch = useStore().dispatch;
// ------- computed
const bot = computed(() => getters[`${moduleName}/getRegisterBot`]);
const data = ref({
    key: '0',
    label: '',
    children: [],
});
const selection = ref({});

onMounted(() => {
    if (bot.value) {
        data.value.label = bot.value.name || '';  // Use bot.value directly
        data.value.children = bot.value.flows.map(flow => ( {
                key: `0_${flow.id}_0`,
                type: 'person',
                data: {
                    image: 'https://primefaces.org/cdn/primevue/images/avatar/annafali.png',
                    name: flow.name,
                    title: 'CMO'
                },
                children: [
                    {
                        key: `0_${flow.id}_0_0`,
                        label: flow.description
                    }
                ]
            })) || []; 
    }
});


</script>

<template>
        <TabView>
            <TabPanel header="Digrama de Flujos">
                <OrganizationChart v-model:selectionKeys="selection" :value="data" collapsible selectionMode="multiple">
                    <template #person="slotProps">
                        <div class="flex flex-column">
                            <div class="flex flex-column align-items-center">
                                <PrimeIconComponent 
                                    :icon="'pi pi-microchip-ai'" 
                                    :color="'neo-text-purple'" 
                                    :label ="title" 
                                    size="2rem"/>
                                <span class="font-bold mb-2">{{ slotProps.node.data.name }}</span>
                                <span v-text="'Flujo'"></span>
                            </div>
                        </div>
                    </template>
                    <template #default="slotProps">
                        <span>{{ slotProps.node.label }}</span>
                    </template>
                </OrganizationChart>
            </TabPanel>
            <TabPanel header="Descripcion para la IA">
                <p class="m-0" v-text="bot.content"></p>
            </TabPanel> 
        </TabView>
</template>
