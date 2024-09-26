<script setup>
import { useStore } from 'vuex';
import { useForm, useField } from "vee-validate";
import { ref, watch } from 'vue';

import registerShapeSchema from "@/components/register/store/register-validate.js";
import InputStringComponent from "@/components/form/InputStringComponent.vue";
import InputMaskComponent from "@/components/form/InputMaskComponent.vue";
import useToastComposable from '@/composable/useToastComposable';
import useConfirmation from '@/composable/useConfirmation';
import LoadingComponent from '../../datatable/LoadingComponent.vue';

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
    <prime-card class="mt-5 w-8">
        <template #title>
            <div class="flex flex-wrap align-items-center mb-3 gap-2">
                <div class="grid mt-2">
                    <div class="sm:col-2 lg:col-2 xl:col-2">
                        <prime-image src="/assets/logo.png" class="mt-2" alt="Image" width="32" />
                    </div>
                    <div class="sm:col-4 lg:col-4 xl:col-4"> <h4 class="mt-2 ml-4">Registro</h4></div>
                </div>
            </div>
        </template>
        <template #content>
            <form v-if="!showLoading" id="frmRegister" @submit.prevent="onSubmit">
                <div class="flex flex-wrap align-items-center mb-3 gap-2">
                    <div className="grid">
                        <div class="sm:col-12 lg:col-12 xl:col-12">
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
                        <div class="sm:col-12 lg:col-12 xl:col-12">
                            <InputMaskComponent
                                label="Telefono"
                                :icon="'fa-solid fa-user'"
                                v-model="phone_number"
                                :placeholder="'Telefono'"
                                :error="errors.phone_number"
                                required
                            />
                        </div>
                        <div class="sm:col-12 lg:col-12 xl:col-12">
                            <InputStringComponent
                                label="Correo"
                                :icon="'fa-solid fa-user'"
                                v-model="email"
                                :placeholder="'correo electronico'"
                                :error="errors.email"
                                required
                            />
                        </div>
                        <div class="sm:col-12 lg:col-12 xl:col-12">
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
                        <div class="sm:col-12 lg:col-12 xl:col-12">
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
            <div class="text-center mb-2">
                <prime-button type="submit" label="Registrase ahora" severity="info" raised form='frmRegister' />
            </div>
            <div class="gird text-center mt-5 mb-2">
                    <p>¿Ya tienes cuenta? <a href="/cliente/entrar">¡Inicia sesion con nosotros!</a></p>    
                </div>
        </template>
    </prime-card>

</template>
