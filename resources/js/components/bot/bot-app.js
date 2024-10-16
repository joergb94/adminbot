import { createRouter, createWebHistory } from "vue-router";
import BotComponent from '@/components/bot/views/BotComponent.vue';
import NavbarComponent from '@/components/layouts/Navbar.vue';
import InputStrignComponent from '@/components/form/InputStringComponent.vue';

import IconField from 'primevue/iconfield';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Card from 'primevue/card';
import Toolbar from 'primevue/toolbar';
import ConfirmDialog from 'primevue/confirmdialog';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import app from "@/base-app";

const routes = [
    { path: '/bots', component: {} },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

app.use(router);



//primevue components
app.component('Toolbar', Toolbar);
app.component('IconField', IconField);
app.component('Image', Image);
app.component('Card', Card);
app.component('ConfirmDialog', ConfirmDialog);
app.component('Button', Button);
app.component('InputText', InputText);
app.component('FontAwesomeIcon',FontAwesomeIcon);
//our components 
app.component('InputStrignComponent',InputStrignComponent);
app.component('navbar-component',NavbarComponent);

//principal component
app.component('bot-component', BotComponent);
app.mount("#app");
