import { createRouter, createWebHistory } from "vue-router";
import HomeComponent from '@/components/home/views/HomeComponent.vue';
import NavbarComponent from '@/components/layouts/Navbar.vue';
import InputStrignComponent from '@/components/form/InputStringComponent.vue';

import IconField from 'primevue/iconfield';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Card from 'primevue/card';
import app from "@/base-app";

const routes = [
    { path: '/cliente/entrar', component: {} },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

app.use(router);

//primevue components
app.component('IconField', IconField);
app.component('Image', Image);
app.component('Card', Card);
app.component('Button', Button);
app.component('InputText', InputText);

//our components 
app.component('InputStrignComponent',InputStrignComponent);
app.component('navbar-component',NavbarComponent);

//principal component
app.component('home-component', HomeComponent);
app.mount("#app");
