<script setup>
import { useStore } from 'vuex';
import { ref, computed, watch, onBeforeMount, onMounted } from 'vue';
import { useForm, useField, Field, useFieldArray } from 'vee-validate';
import { FlowShapeSchema } from '../validations/FlowShapeSchema.js';
import useToastComposable from '@/composable/useToastComposable';
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import ImageZoomComponent from "@/components/form/ImageZoomComponent.vue";
import Button from 'primevue/button';


const displaySize = ref(window.innerWidth);
// ------- Common variables
const moduleName = 'storeBot';

const props = defineProps({
    flows: {
        type: Array,
        default: [],
    },
});


// ------- useStore
const getters = useStore().getters;
const dispatch = useStore().dispatch;
const flows = computed(() => props.flows);

// ------- useConfirm and UseForm
const { toast } = useToastComposable();

const { handleSubmit, errors, setValues } = useForm({
    validationSchema: FlowShapeSchema,
    initialValues: getters[`${moduleName}/getFlowInitialValues`],
});

const { value: name } = useField('name');
const { value: description } = useField('description');
const { value: sort } = useField('sort');

const onSubmit = handleSubmit((data) => {
  try {
        valideteFlowName(data.name)
        dispatch(`${moduleName}/modalRequest`, { action:'AddFlowRequest', params: data, toast }).then(()=>{
                setValues({
                    name: '',
                    description: '',
                    sort: ''
                });
        });
    
  } catch (error) {
        toast('error', 'Error', error);
  }
  
});

const valideteFlowName = (name) =>{
    const result = flows.value.filter(item => item.name === name);
    if(result.length > 0){
        throw new Error('El nombre del flujo no se puede repetir');
    }

    return result.length;

}
</script>

<template>
    <div class="col-12">
        <form id="frmAddFlow" @submit="onSubmit($event)">
                        <div class="grid">
                            <div class="sm:col-6">
                                    <InputStringComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="name"
                                    :error="errors.name"
                                    :required="true"
                                    label="Nombre"
                                    />
                            </div>
                            <div class="sm:col-6">
                                <InputStringComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="sort"
                                    :error="errors.sort"
                                    :required="true"
                                    label="Orden"
                                />
                            </div>
                            <div class="sm:col-12">
                                <InputStringComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="description"
                                    :error="errors.description"
                                    :required="true"
                                    label="Descripcion"
                                />
                            </div>
                            <div class="sm:col-12 text-center">
                                <Button label="Agrega flujo" icon="pi pi-plus" form="frmAddFlow" type="submit" severity="success" class="mt-4" />
                                <Toast />
                            </div>
                        </div>
        </form>
    </div>
</template>
<style scoped>
.custom-file-upload .p-fileupload-buttonbar {
    display: none;
}
</style>
