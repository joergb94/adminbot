<script setup>
import { useStore } from 'vuex';
import { useForm, useField } from "vee-validate";
import { ref, watch } from 'vue';

import registerShapeSchema from "@/components/register/store/register-validate.js";
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import InputMaskComponent from "@/components/form/InputMaskComponent.vue";
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';

const dispatch = useStore().dispatch;
const getters = useStore().getters;
const moduleName ='storeRegister';
const showLoading = ref(false);
const { confirmAction } = useConfirmation();
const { toast } = useToastComposable();

const { handleSubmit, errors, setValues } = useForm({
    validationSchema: registerShapeSchema,
    initialValues: {
        name: "",
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
        password: "",
        password_confirmation: "",
    },
});

const { value: name } = useField("name");
const { value: first_name } = useField("first_name");
const { value: last_name } = useField("last_name");
const { value: email } = useField("email");
const { value: phone_number } = useField("phone_number");
const { value: password } = useField("password");
const { value: password_confirmation } = useField("password_confirmation");

watch(() => getters[`${moduleName}/getShowLoading`],(show) => {showLoading.value = show;});

const onSubmit = handleSubmit(async (data) => {
    confirmAction('En un momento te enviaremos un correo electrónico para la verificación.', {
        header:'¿ Estas seguro de realizar esta accion ?',
        accept: () => {
            const action = 'signUpRequest';
            dispatch(`${moduleName}/moduleRequest`, { action, params: data, toast });
        }, 
    });
  
});
</script>

<template>
    <Toast />
    <ConfirmDialog class="sm:col-12 lg:col-4 xl:col-4"></ConfirmDialog>
 
    <div class="grid grid-cols-1 md:grid-cols-2 h-screen w-full justify-center items-center">
        <div class="col w-full flex justify-center mt-5 ml-5 mb-5">
            <div class="ml-5 col-10 col-offset-1" >
                <div class="col-offset-1 col-10 text-left">
                    <prime-image src="/assets/logo.png" alt="Image" width="150px" />
                </div>
                <div class="pt-5 col-offset-1 col-10 text-center">
                <h2 class="mt-5 mb-5 text-white">Ampliamos y mejoramos <br> el proceso de tu soporte</h2>
                <p class="mt-5 mb-5 text-white">Ponte en contactro con nuesto equipo y<br>
                    te ayudaremos a automatizar las <br>
                    solicitudes de tus clientes</p>
                </div>
            </div>
        </div>
        <div class="col w-full flex justify-center mt-5 mr-5 mb-5">
            
            <div class="ml-5 col-10 col-offset-1" >
                <prime-card class="ml-5 mt-5 rounded-card-form text-center surface-300 w-80 h-70">
                    <template #content>
                        <form v-if="!showLoading" id="frmRegister" @submit.prevent="onSubmit">
                            <div class="grid mt-2 mr-2 ml-2">
                                <div className="grid">
                                    <div class="mt-2 col-5 col-offset-1">
                                        <InputStringComponent
                                            label="Nombre(s)"
                                            icon="fa-solid fa-user"
                                            v-model="name"
                                            placeholder="Nombre(s)"
                                            required
                                            :error="errors.name"
                                            :show-only-value="false"
                                        />
                                    </div>
                                    <div class="mt-2 col-5">
                                        <InputStringComponent
                                            label="Apellido(s)"
                                            icon="fa-solid fa-user"
                                            v-model="name"
                                            placeholder="Apellido(s)"
                                            required
                                            :error="errors.name"
                                            :show-only-value="false"
                                        />
                                    </div>
                                    <div class="mt-2 col-5 col-offset-1">
                                        <InputMaskComponent
                                            label="Telefono"
                                            :icon="'fa-solid fa-user'"
                                            v-model="phone_number"
                                            :placeholder="'Telefono'"
                                            :error="errors.phone_number"
                                            required
                                        />
                                    </div>
                                    <div class="mt-2 col-5">
                                        <InputStringComponent
                                            label="Correo"
                                            :icon="'fa-solid fa-user'"
                                            v-model="email"
                                            :placeholder="'correo electronico'"
                                            :error="errors.email"
                                            required
                                        />
                                    </div>
                                    <div class="mt-2 col-10 col-offset-1">
                                        <InputStringComponent
                                            label="Contraseña"
                                            :icon="'fa-solid fa-user'"
                                            v-model="password"
                                            type="password"
                                            :placeholder="'correo electronico'"
                                            :error="errors.password"
                                            required
                                        />
                                    </div>
                                    <div class="mt-2 col-10 col-offset-1">
                                        <InputStringComponent
                                            label="Confirmar Contraseña"
                                            :icon="'fa-solid fa-user'"
                                            v-model="password_confirmation"
                                            type="password"
                                            :placeholder="'confirmar contraseña'"
                                            :error="errors.password_confirmation"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="grid col-12">
                            <LoadingComponent v-if="showLoading" title="Generando su cuenta..."/>
                        </div>
                    </template>
                    <template v-if="!showLoading" #footer>
                        <div class="grid mt-2 mr-2 ml-2 text-center">
                            <prime-button type="submit" label="Registrase ahora" :class="'button-flexbetta col-10 col-offset-1'" raised form='frmRegister' />
                        </div>
                        <div class="gird text-center mt-5 mb-2">
                                <p>¿Ya tienes cuenta? <a href="/login">¡Inicia sesion con nosotros!</a></p>    
                            </div>
                    </template>
                </prime-card>
           </div>
        </div>
    </div>
</template>
