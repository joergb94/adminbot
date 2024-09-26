import { createRouter, createWebHistory } from "vue-router";
import ErrorPageComponent from '@/components/errors/views/ErrorPageComponent.vue';
import NavbarComponent from '@/components/layouts/Navbar.vue';

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
app.component('navbar-component',NavbarComponent);
app.component('error-page-component', ErrorPageComponent);
app.mount("#app");