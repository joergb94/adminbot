<script setup>
import { useStore } from 'vuex';
import { computed, ref, watch } from 'vue';
import NoFoundDataComponent from '@/components/datatable/NoFoundDataComponent.vue'
import DataView from 'primevue/dataview';
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();


const props = defineProps({
    flows: {
        type: Array,
        required: true,
    },
    deleteFlow: {
        type: Function,
        required: true,
    },
    
});
const flows = computed(() => props.flows);
</script>

<template>
        <DataView :value="flows" paginator :rows="3">
            <template #list="slotProps">
                <div class="grid grid-nogutter">
                    <div v-for="(item, index) in slotProps.items" :key="index" class="col-12">
                        <div class="flex flex-column sm:flex-row sm:align-items-center p-4 gap-3" :class="{ 'border-top-1 surface-border': index !== 0 }">
                            <div class="md:w-10rem relative">
                                <div class="text-lg font-medium text-900 mt-2">{{ item.name }}</div>
                            </div>
                            <div class="flex flex-column md:flex-row justify-content-between md:align-items-center flex-1 gap-4">
                                <div class="flex flex-row md:flex-column justify-content-between align-items-start gap-2">
                                    <div>
                                        <span class="font-medium text-secondary text-sm">{{ item.description }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-column md:align-items-end gap-5">
                                    <div class="flex flex-row-reverse md:flex-row gap-2">
                                        <Button icon="pi pi-trash" severity="danger"  @click="props.deleteFlow(index)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template #empty>
                <NoFoundDataComponent  title="No hay flujos" />
            </template>
        </DataView>
</template>
