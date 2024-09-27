<script setup>
import { useStore } from 'vuex';
import { useForm, useField } from "vee-validate";
import { ref, watch } from 'vue';
import loginShapeSchema from "@/components/login/store/login-validate";
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';
import LoadingComponent from '../../datatable/LoadingComponent.vue';
import InputGroup from 'primevue/inputgroup';

const dispatch = useStore().dispatch;
const getters = useStore().getters;
const moduleName ='storeLogin';
const showLoading = ref(false);

const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();

const { handleSubmit, errors, setValues } = useForm({
    validationSchema: loginShapeSchema,
    initialValues: getters[`${moduleName}/getInitialValues`],
});

const { value: email } = useField("email");
const { value: password } = useField("password");

watch(() => getters[`${moduleName}/getShowLoading`],(show) => {showLoading.value = show;});

const onSubmit = handleSubmit(async (data) => {
    const action = 'signInRequest';
    dispatch(`${moduleName}/moduleRequest`, { action, params: data, toast });
});
</script>

<template>
    <Toast />
    <div class="grid grid-cols-1 md:grid-cols-2 h-screen w-full justify-center items-center">
        <div class="col w-full v-full flex justify-center mt-5 ml-5 mb-5 from-robot-adjust">
           <div class="ml-5 col-10 col-offset-1" >
            <prime-card style="height: max-content; width: max-content;" class="ml-5 mt-5 rounded-card-form text-center surface-300 w-80 h-70">
                <template #title>
                    <div class="grid mt-2 mr-2 ml-2">
                        <div class="col-10 col-offset-1 text-center">
                            <prime-image src="/assets/logo.png" alt="Image" width="150px" />
                            <h2 class="mt-2 text-black-alpha-90"> <b>¡Inicia sesión en FlexDialog!</b></h2>
                        </div>
                    </div>
                </template>
                <template #subtitle>
                    <div class="grid mt-2 mr-2 ml-2">
                        <div class="col-10 col-offset-1 text-left">
                            <p class="text-white">Descubre la automatización definitiva para <br/> transformar tu atención al cliente.</p>
                        </div>
                    </div>
                </template>
                <template #content>
                    <form id="frmLogin" @submit.prevent="onSubmit">
                        <div v-if="!showLoading" class="grid mt-2 mr-2 ml-2">
                            <div class="col-10 col-offset-1">
                                <InputStringComponent
                                    v-model="email"
                                    label="correo electrónico"
                                    :placeholder="'correo@electrónico'"
                                    :error="errors.email"
                                    required
                                />
                            </div>
                            <div class="col-10 col-offset-1">
                                <InputStringComponent
                                    v-model="password"
                                    label="Contraseña"
                                    type="password"
                                    :placeholder="'Contraseña'"
                                    :error="errors.password"
                                    required
                                />
                            </div>
                            <div class="col-12 text-center mb-2">
                                <a href="/registro">¿Olvidó su contraseña?</a>
                            </div> 
                        </div>
                        <div class="grid col-12">
                            <LoadingComponent v-if="showLoading" title="Iniciando sesión..." />
                        </div>
                    </form>
                </template>
                <template v-if="!showLoading" #footer>
                    <div class="grid mt-2 mr-2 ml-2 text-center">
                        <prime-button type="submit" label="Iniciar Sesión" :class="'button-flexbetta col-10 col-offset-1'" raised form="frmLogin" />
                    </div>
                    <div class="grid text-center mt-5 mr-2 ml-2 mb-5">
                        <div class="col-10 col-offset-1">
                            <p> ¡Para crear un bot tendrás que <a href="/registro">crear una cuenta</a> o ingresar a ella si ya la tienes!</p>
                        </div>
                    </div>
                </template>
            </prime-card>
           </div>
        </div>
        <div class="col w-full flex justify-center mt-5 mr-5 mb-5">
            <prime-image class="robot-adjust" src="/assets/Robot.png" alt="Image" width="100%" />
        </div>
    </div>


</template>
