<script setup>
import { useStore } from 'vuex';
import { ref, computed, watch, onBeforeMount, onMounted } from 'vue';
import { useFieldArray, useForm, useField } from 'vee-validate';
import AddFlowsComponent from '../components/AddFlowsComponent.vue';
import DataViewFlows from '../components/DataViewFlows.vue';
import { BotShapeSchema } from '@/components/bot/validations/BotShapeSchema';
import useConfirmation from '@/composable/useConfirmation';
import useToastComposable from '@/composable/useToastComposable';
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import InputText from "primevue/inputtext";
import DropdownComponent from "@/components/form/DropdownComponent.vue";
import InputMaskComponent from "@/components/form/InputMaskComponent.vue";
import InputTextareaComponent from "@/components/form/InputTextareaComponent.vue";
import InputBooleanComponent from "@/components/form/InputBooleanComponent.vue";
import NoFoundDataComponent from '@/components/datatable/NoFoundDataComponent.vue'
import ErrorMessageComponent from "@/components/form/ErrorMessageComponent.vue";
import ErrorSteperComponent from "@/components/form/ErrorSteperComponent.vue";
import DataTable from 'primevue/datatable';
import ProgressBar from 'primevue/progressbar';
import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';


// ------- Common variables
const { toast } = useToastComposable();
const moduleName = 'storeBot';
const errorsStep1 = ref(0);
const errorsStep2 = ref(0);
const errorsStep3 = ref(0);

// ------- useStore
const getters = useStore().getters;
const dispatch = useStore().dispatch;

// ------- computed
const showFormProgressBar = computed(() => getters[`${moduleName}/getShowFormProgressBar`]);
const bot = computed(() => getters[`${moduleName}/getRegisterBot`]);
const validateBotName = computed(() => getters[`${moduleName}/getRegisterValidateBotName`]);
const newFlow = computed(() => getters[`${moduleName}/getRegisterFlow`]);
const registers = computed(() => getters['registers/getRegistersAll']);
// ------- useConfirm and UseForm
const { confirmAction } = useConfirmation();

const { handleSubmit, errors, setValues } = useForm({
    validationSchema: BotShapeSchema,
    initialValues: getters[`${moduleName}/getInitialValues`],
});

const newErros = errors;
const { value: name } = useField('name');
const { value: description } = useField('description');
const { value: content } = useField('content');
const { value: telegram_bot } = useField('telegram_bot');
const { value: whatsapp_number } = useField('whatsapp_number');
const { value: start_message } = useField('start_message');
const { value: language } = useField('language');
const { value: flows } = useField('flows');
const new_flows = ref([]);
const is_start_message = ref(false);

//--------before for mount
onBeforeMount(() => {
    const registers = [{ name: 'languages' }];
    dispatch('registers/findRegistersAllRequest', { registers, toast });
});


onMounted(() => {
    if (bot.value?.id) {
        setValues(bot.value);
         new_flows.value = flows.value;
    }
});


watch(newFlow, (newVal) => {
    new_flows.value.unshift(newFlow.value);
    flows.value = new_flows.value;
});


watch(() =>  getters[`${moduleName}/getRegisterBot`],(newbot)=>{
    if(bot.value?.name){
        setValues(newbot);
    }else{
        setValues(getters[`${moduleName}/getInitialValuesName`],);
    }
});

watch(
      () => errors.value, 
      (newErrors) => countErros(newErrors) 
    );

watch(is_start_message,(new_is_start_message) => {
        start_message.value = is_start_message.value?start_message.value:null;
});

watch([description, new_flows, start_message], (new_description, new_new_flows, new_start_message) => {

    content.value = '';

    // Update content if description has changed and is valid
    if (description.value && description.value.length > 0) {
        content.value = description.value;

        if (is_start_message.value) {
            content.value += `\nY tu saludo inicial será: ${start_message.value || ''}.`;
        }

        if (Array.isArray(new_flows.value) && new_flows.value.length > 0) {
            new_flows.value.forEach(element => {
                if (element.description) {
                    content.value += ` ,${element.description}`;
                }
            });
        }
    }
});


const onPressName = (e) => {
    
    const parms ={ name:e.target.value}
    const action = 'findRegisterBotByNameRequest';
    dispatch(`${moduleName}/modalRequest`, { action, params: parms, toast });
    e.preventDefault();
};




const countErros = (errors) =>{
    errorsStep1.value = 0;
    errorsStep2.value = 0;
    errorsStep3.value = 0;

    errorsStep1.value = errors.name? errorsStep1.value + 1: errorsStep1.value;
    errorsStep1.value = errors.content? errorsStep1.value + 1: errorsStep1.value;
    errorsStep1.value = errors.start_message? errorsStep1.value + 1: errorsStep1.value;
    errorsStep1.value = errors.language? errorsStep1.value + 1: errorsStep1.value;

    errorsStep2.value = errors.telegram_bot? errorsStep2.value + 1: errorsStep2.value;
    errorsStep2.value = errors.whatsapp_number? errorsStep2.value + 1: errorsStep2.value;

    errorsStep3.value = errors.flows? errorsStep3.value + 1: errorsStep3.value;
   
}

// ------- Submit FORM
const onSubmit = handleSubmit((data) => {
    countErros(errors.value);
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:'Guardar datos de este bot',
        accept: () => {
            const params = data;
            const action = 'id' in data && data.id != null? 'updateRegisterBotRequest' : 'storeRegisterBotRequest';
            dispatch(`${moduleName}/modalRequest`, { action, params: params, toast });
        }, 
    });
  
});

const deleteFlow = (index) => {
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:'Eliminar datos de este flujo',
        accept: () => {
            flows.value.splice(index, 1);
            new_flows.value = flows.value;
        }, 
    });
}

</script>

<template>
    <ProgressBar mode="indeterminate" style="height: 1px" v-show="showFormProgressBar" />
            <form id="frmBot" @submit="onSubmit">
                <div class="card">
                    <Stepper >
                        <StepperPanel>
                            <template #header="{ index, clickCallback }">
                                <button class="bg-transparent border-none inline-flex flex-column gap-2" @click="clickCallback">
                                    <span >
                                        Diseña <i class="pi pi-hammer" /> <span class="p-stepper-number" data-pc-section="number">1</span>
                                    </span>
                                    <ErrorSteperComponent :errorStep="errorsStep1"></ErrorSteperComponent>
                                </button>
                            </template>
                            <template #content="{ nextCallback }">
                                <div class="flex flex-column text-left h-full">
                                    <div class="col-12">
                                        <div class="grid">
                                            <div class="sm:col-12 lg:col-12 xl:col-12">
                                                    <label class="text-xs text-600">Nombre del Proceso</label>
                                                    <span class="pr-1 text-red-600">*</span>
                                                    <small class="text-green-500" v-text="validateBotName"></small>
                                                    <div class="p-inputgroup flex-1">
                                                        <InputText 
                                                            class="p-inputtext-sm font-bold"
                                                            :class="{ 'p-invalid': errors.name }"
                                                            @change="onPressName" 
                                                            v-model="name"
                                                        />
                                                    </div>
                                                    <ErrorMessageComponent :message="errors.name"></ErrorMessageComponent>
                                            </div>
                                            <div class="sm:col-12 lg:col-12 xl:col-12">
                                                <InputTextareaComponent
                                                    icon="fa-solid fa-building-user"
                                                    v-model="description"
                                                    :error="errors.description"
                                                    :required="true"
                                                    label="Descripcion del bot"
                                                />
                                            </div>
                                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                                <InputBooleanComponent
                                                    v-model="is_start_message"
                                                    label="¿Desea establecer un mensaje inicial?"
                                                />
                                            </div>
                                            <div class="sm:col-8 lg:col-8 xl:col-8">
                                                <InputStringComponent
                                                    v-if="is_start_message"
                                                    icon="fa-solid fa-building-user"
                                                    v-model="start_message"
                                                    :error="errors.start_message"
                                                    :required="true"
                                                    label="Mensaje de inicio"
                                                />
                                            </div>
                                            <div class="sm:col-12 lg:col-12 xl:col-12">
                                                <DropdownComponent
                                                    icon="fa-solid fa-building-columns"
                                                    v-model="language"
                                                    :options="registers.languages || []"
                                                    optionLabel="name"
                                                    :filter="true"
                                                    :error="errors.language"
                                                    label="Lenguaje"
                                                    :required="true"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex pt-4 justify-content-end">
                                    <Button label="Siguiente" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                                </div>
                            </template>
                        </StepperPanel>
                        <StepperPanel >
                            <template #header="{ index, clickCallback }">
                                <button class="bg-transparent border-none inline-flex flex-column gap-2" @click="clickCallback">
                                    <span >
                                        Conecta <i class="pi pi-globe" /> <span class="p-stepper-number" data-pc-section="number">2</span>
                                    </span>
                                    <ErrorSteperComponent  :errorStep="errorsStep2"></ErrorSteperComponent>
                                </button>
                            </template>
                            <template #content="{ prevCallback, nextCallback }">
                                <div class="flex flex-column ">
                                   <div class="col-12">
                                    <div class="grid">
                                            <div class="sm:col-12 lg:col-6 xl:col-6">
                                                <InputMaskComponent 
                                                    icon="fa-solid fa-mobile" 
                                                    v-model="telegram_bot"
                                                    :error="errors.telegram_bot" 
                                                    label="Bot de telegram" />
                                            </div>
                                            <div class="sm:col-12 lg:col-6 xl:col-6">
                                                <InputMaskComponent
                                                    icon="fa-solid fa-mobile"
                                                    v-model="whatsapp_number"
                                                    :error="errors.whatsapp_number"
                                                    label="Numero de whatsapp"
                                                />
                                            </div>
                                        </div>
                                   </div>
                                </div>
                                <div class="flex pt-4 justify-content-between">
                                    <Button label="Anterior" severity="secondary" icon="pi pi-arrow-left" @click="prevCallback" />
                                    <Button label="Siguiente" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                                </div>
                            </template>
                        </StepperPanel>
                        <StepperPanel >
                            <template #header="{ index, clickCallback }">
                                <button class="bg-transparent border-none inline-flex flex-column gap-2" @click="clickCallback">
                                    <span >
                                        Proceso <i class="pi pi-microchip-ai" /> <span class="p-stepper-number" data-pc-section="number">3</span>
                                    </span>
                                    <ErrorSteperComponent :errorStep="errorsStep3"></ErrorSteperComponent>
                                </button>
                            </template>
                            <template #content="{ prevCallback }">
                                <div class="flex flex-column ">
                                    <div class="col-12">
                                    <div class="grid">
                                            <div class="col-6">
                                                <h3>Agrega tus flujos</h3>
                                                <AddFlowsComponent :flows = "new_flows"/>
                                            </div>
                                            <div class="col-6">
                                                <h3>Flujos</h3>
                                                <DataViewFlows :flows="new_flows" :deleteFlow="deleteFlow"/>
                                                <ErrorMessageComponent :message="errors.flows"></ErrorMessageComponent>
                                            </div>
                                    </div>
                                   </div>
                                </div>
                                <div class="flex pt-4 justify-content-start">
                                    <Button label="Anterior" severity="secondary" icon="pi pi-arrow-left" @click="prevCallback" />
                                </div>
                            </template>
                        </StepperPanel>
                    </Stepper>
                </div>
            </form>
</template>
<style scoped>
.custom-file-upload .p-fileupload-buttonbar {
    display: none;
}
</style>
