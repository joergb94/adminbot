import { createRouter, createWebHistory } from "vue-router";
import VerificationCardComponent from '@/components/verification/views/VerificationCardComponent.vue';
import app from "@/base-app";

const routes = [
    { path: '/cliente/registro', component: {} },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

app.use(router);

//register form component
app.component('verification-card-component', VerificationCardComponent);
app.mount("#app");