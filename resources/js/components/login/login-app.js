import { createRouter, createWebHistory } from "vue-router";
import LoginFormComponent from '@/components/login/views/LoginFormComponent.vue';
import app from "@/base-app";


const routes = [
    { path: '/cliente/entrar', component: {} },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

app.use(router);

app.component('login-form-component', LoginFormComponent);
app.mount("#app");
