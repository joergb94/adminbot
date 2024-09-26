<script setup>
import { computed, inject } from 'vue';
import InputStringComponent from '../../../../components/form/InputStringComponent.vue';
import { useField, useForm } from 'vee-validate';
import { EntitySearchShapeSchema } from '../store/EntityShapeSchema';
import { findRegisterEntityByRFCService } from '../services/RegisterEntityService';
import useShowProgressBar from '@src/composable/UseShowProgressBar.js';
import { useStore } from 'vuex';

import useToastComposable from '@/composable/useToastComposable';

const { toast } = useToastComposable();


// ------- props
const props = defineProps({
    moduleName: {
        type: String,
        default: 'registerEntity',
    },
});

const commit = useStore().commit;

//------ libraries
const { showModalProgressBar } = useShowProgressBar();

// ------- computed and getters, setters
const moduleName = computed(() => props.moduleName);

// -------  vee-validate, useForm and useField
const { handleSubmit, errors } = useForm({
    validationSchema: EntitySearchShapeSchema,
    initialValues: { rfc: '' },
});

const { value: rfc } = useField('rfc');

// ------- submit
const onSubmit = handleSubmit(async (data) => {
    showModalProgressBar(`${moduleName.value}`, true);
    try {
        const params = { rfc: data.rfc.trim() };
        const response = await findRegisterEntityByRFCService(params, toast);
        commit(`registerEntity/setSegisterEntitySearch`, response.data.record);
    } catch (errors) {
        toast('error', 'Error.', errors.response.data.message);
    }
    showModalProgressBar(`${moduleName.value}`, false);
});
</script>

<template>
    <form id="registerEntityFormSearch" @submit="onSubmit">
        <InputStringComponent
            placeholder="Busqueda de RFC"
            icon="fa-solid fa-cart-shopping"
            v-model="rfc"
            label="RFC de la empresa"
            :error="errors.rfc"
            required="true"
        />
    </form>
</template>
