import { createRouter, createWebHistory } from "vue-router";
import RegisterFormComponent from '@/components/register/views/RegisterFormComponent.vue';
import ConfirmDialog from 'primevue/confirmdialog';

import app from "@/base-app";

const routes = [
    { path: '/cliente/registro', component: {} },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

app.use(router);
app.component('ConfirmDialog', ConfirmDialog);
//register form component
app.component('register-form-component', RegisterFormComponent);
app.mount("#app");