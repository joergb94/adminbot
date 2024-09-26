<script setup>
import { useStore } from 'vuex';
import { computed, watch, onBeforeMount, onMounted } from 'vue';
import { useForm, useField } from 'vee-validate';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { EntityShapeSchema } from '../store/EntityShapeSchema';
import useConfirmation from '@/composable/useConfirmation';
import useToastComposable from '@/composable/useToastComposable';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import InputText from "primevue/inputtext";
import DropdownComponent from "@/components/form/DropdownComponent.vue";
import InputNumber from 'primevue/inputnumber';
import InputMaskComponent from "@/components/form/InputMaskComponent.vue";
import ProgressBar from 'primevue/progressbar';


// ------- Common variables
const { toast } = useToastComposable();
const moduleName = 'registerEntity';
const defaulCountry = { id: 142, name: 'Mexico' };

// ------- useStore
const getters = useStore().getters;
const dispatch = useStore().dispatch;

// ------- computed
const showFormProgressBar = computed(() => getters[`${moduleName}/getShowFormProgressBar`]);
const entity = computed(() => getters[`${moduleName}/getRegisterEntity`]);
const registers = computed(() => getters['registers/getRegistersAll']);

// ------- useConfirm and UseForm
const { confirmAction } = useConfirmation();

const { handleSubmit, errors, setValues } = useForm({
    validationSchema: EntityShapeSchema,
    initialValues: getters[`${moduleName}/getInitialValues`],
});

const { value: business_name } = useField('business_name');
const { value: email } = useField('email');
const { value: first_phone } = useField('first_phone');
const { value: second_phone } = useField('second_phone');
const { value: rfc } = useField('rfc');
const { value: tax_regime } = useField('tax_regime');
const { value: tax_regime_options } = useField('tax_regime_options');

// ------- data address
const { value: street } = useField('address.street');
const { value: int } = useField('address.int');
const { value: ext } = useField('address.ext');
const { value: country } = useField('address.country');
const { value: state } = useField('address.state');
const { value: municipality } = useField('address.municipality');
const { value: neighbourhood } = useField('address.neighbourhood');
const { value: neighbourhoods } = useField('address.neighbourhoods');
const { value: postal_code } = useField('address.postal_code');
const { value: reference } = useField('address.reference');

//--------before for mount
onBeforeMount(() => {
    const registers = [{ name: 'tax_regime_code' }];
    dispatch('registers/findRegistersAllRequest', { registers, toast });
});


onMounted(() => {
    if (entity.value?.id) {
        setValues(entity.value);
        postal_code.value = parseInt(entity.value.address.postal_code);
    }
});

// ------- watches
watch(
    () => getters[`${moduleName}/getAddress`],
    (newAddress) => {
        
        state.value = newAddress.state;
        municipality.value = newAddress.municipality;
        neighbourhood.value = newAddress.neighbourhood;
        neighbourhoods.value = newAddress.neighbourhoods;
    },
    { deep: true }
);


watch(  () =>  getters[`${moduleName}/getRegisterEntity`],(newEntity)=>{
    if(entity.value?.business_name){
        setValues(newEntity);
    }else{
        setValues(getters[`${moduleName}/getInitialValuesRFC`],);
    }
});


watch([postal_code], (postal_codeNew) => {  
        if(postal_codeNew.length > 0){
            country.value = defaulCountry;
            const data = { zip: postal_codeNew[0] };
            const action = 'findPostalCodeRequest';
            dispatch(`${moduleName}/modalRequest`, { action, params: data, toast });
        }
 });




const onPressRFC = (e) => {
    
    if(e.target.value.length >= 12){
        const parms ={ rfc:e.target.value}
        const action = 'findRegisterEntityByRFCRequest';
        dispatch(`${moduleName}/modalRequest`, { action, params: parms, toast });
    }
    e.preventDefault();
};




// ------- Submit FORM
const makeData = (data) => {
    data.address.neighbourhood_id = data.address.neighbourhood.id;
    data.address.municipality_id = data.address.municipality.id;
    data.address.state_id = data.address.state.id;
    data.address.country_id = data.address.country.id;
    data.tax_regime_id = data.tax_regime.id;
    return data;
};

const onSubmit = handleSubmit((data) => {
    confirmAction('¿ Estas seguro de realizar esta accion ?', {
        header:'Guardar datos de esta empresa',
        accept: () => {
            data = makeData(data);
            const action = 'id' in data && data.id != null? 'updateRegisterEntityRequest' : 'storeRegisterEntityRequest';
            dispatch(`${moduleName}/modalRequest`, { action, params: data, toast });
        }, 
    });
  
});

</script>

<template>
    <ProgressBar mode="indeterminate" style="height: 1px" v-show="showFormProgressBar" />
    <TabView>
        <TabPanel header="Registro Fiscal">
            <form id="frmEntity" @submit="onSubmit">
                <Card>
                    <template #title>
                        <div class="text-xl font-bold">Registro Fiscal</div>
                    </template>
                    <template #subtitle>
                        <div class="text-base mb-3">
                            <fontAwesomeIcon icon="fa-solid fa-circle-info" class="mr-1 text-primary-700" />Información fiscal de la empresa
                        </div>
                    </template>
                    <template #content>
                        <div class="grid">
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                    <span class="pr-1 text-red-600">*</span>
                                    <label class="text-xs text-600">RFC</label>
                                    <div class="p-inputgroup flex-1">
                                        <span class="p-inputgroup-addon">
                                            <fontAwesomeIcon :icon="'fa-solid fa-building-user'" class="mr-1 text-primary-700" />
                                        </span>
                                        <InputText 
                                            class="p-inputtext-sm font-bold"
                                            @change="onPressRFC" 
                                            v-model="rfc"
                                            :error="errors.rfc"
                                        />
                                    </div>
                            </div>
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <InputStringComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="business_name"
                                    :error="errors.business_name"
                                    :required="true"
                                    label="Nombre o Razón Social"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <InputStringComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="email"
                                    :error="errors.email"
                                    :required="true"
                                    :placeholder="'example@example.com'"
                                    label="Correo Electronico"
                                />
                            </div>
                        </div>
                        <div class="grid">
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <InputMaskComponent 
                                    icon="fa-solid fa-mobile" 
                                    v-model="first_phone"
                                    :error="errors.first_phone" 
                                    label="Telefono" />
                            </div>
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <InputMaskComponent
                                    icon="fa-solid fa-mobile"
                                    v-model="second_phone"
                                    :error="errors.second_phone"
                                    label="Telefono Alternativo"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <DropdownComponent
                                    icon="fa-solid fa-building-columns"
                                    v-model="tax_regime"
                                    :options="registers.tax_regime_code || []"
                                    optionLabel="name"
                                    :filter="true"
                                    :error="errors.tax_regime"
                                    label="Regimen fiscal"
                                    :required="true"
                                />
                            </div>
                        </div>
                    </template>
                </Card>
                <Card class="mt-4">
                    <template #title>
                        <div class="text-xl font-bold">Dirección Fiscal</div>
                    </template>
                    <template #subtitle>
                        <div class="text-base mb-3">
                            <fontAwesomeIcon icon="fa-solid fa-circle-info" class="mr-1 text-primary-700" />Dirección Fiscal de la Empresa
                        </div>
                    </template>
                    <template #content>
                        <div class="grid">
                            <div class="sm:col-12 lg:col-8 xl:col-8">
                                <InputStringComponent
                                    icon="fa-solid fa-building"
                                    v-model="street"
                                    :error="errors['address.street']"
                                    label="Direccion Fiscal"
                                    :required="true"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-2 xl:col-2">
                                <InputStringComponent
                                    icon="fa-solid fa-hashtag"
                                    v-model="ext"
                                    label="Numero Exterior"
                                    :error="errors['address.ext']"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-2 xl:col-2">
                                <InputStringComponent icon="fa-solid fa-hashtag" v-model="int" label="Numero Interior" />
                            </div>
                        </div>
                        <div class="grid">
                            <div class="sm:col-12 lg:col-2 xl:col-2">
                                <span class="pr-1 text-red-600">*</span>
                                <label class="text-xs text-600">Codigo postal</label>
                                <div class="p-inputgroup flex-1 ">
                                    <span class="p-inputgroup-addon">
                                        <fontAwesomeIcon :icon="'fa-solid fa-location-crosshairs'" class="mr-1 text-primary-700" />
                                    </span>
                                    <InputNumber
                                        class="p-inputtext-sm font-bold"
                                        v-model="postal_code"
                                        :error="errors['address.postal_code']"
                                        placeholder="Codigo postal"
                                    />
                                </div>
                            </div>
                            <div class="sm:col-12 lg:col-3 xl:col-3">
                                <DropdownComponent
                                    icon="fa-solid fa-map-pin"
                                    v-model="neighbourhood"
                                    :options="neighbourhoods"
                                    optionLabel="name"
                                    placeholder="Colonias"
                                    label="Colonias"
                                    :error="errors['address.neighbourhood']"
                                    :required="true"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-4 xl:col-4">
                                <DropdownComponent
                                    icon="fa-solid fa-map-pin"
                                    v-model="municipality"
                                    optionLabel="name"
                                    placeholder="Municipios"
                                    label="Municipios"
                                    :error="errors['address.municipality']"
                                    :required="true"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-3 xl:col-3">
                                <DropdownComponent
                                    icon="fa-solid fa-map-pin"
                                    v-model="state"
                                    optionLabel="name"
                                    label="Estados"
                                    placeholder="Estados"
                                    :error="errors['address.state']"
                                    :required="true"
                                />
                            </div>
                            <div class="sm:col-12 lg:col-3 xl:col-3" v-show="false">
                                <DropdownComponent
                                    icon="fa-solid fa-building-user"
                                    v-model="country"
                                    optionLabel="name"
                                    label="Pais"
                                    :error="errors['address.country']"
                                    :required="true"
                                />
                            </div>

                        </div>
                        <div class="grid">
                            <div class="sm:col-12 lg:col-12 xl:col-12">
                                <InputStringComponent
                                    icon="fa-solid fa-magnifying-glass-location"
                                    v-model="reference"
                                    label="Referencia"
                                    :error="errors['address.reference']"
                                />
                            </div>
                        </div>
                    </template>
                </Card>
            </form>
        </TabPanel>
    </TabView>
</template>
<style scoped>
.custom-file-upload .p-fileupload-buttonbar {
    display: none;
}
</style>
