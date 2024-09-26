import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/lara-light-blue/theme.css'
import 'primeflex/primeflex.scss';
import 'primeicons/primeicons.css';


import { createApp } from 'vue';
import PrimeVue from "primevue/config";
import Button from 'primevue/button';
import Card from 'primevue/card';
import Image from 'primevue/image';
import Toast from 'primevue/toast';
import Dialog from 'primevue/dialog';



import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';
import DialogService from 'primevue/dialogservice'
import Ripple from 'primevue/ripple';
import store from './store';

library.add(fas);
const app = createApp({});

app.use(PrimeVue, { ripple: true  });
app.use(ConfirmationService);
app.use(ToastService);
app.use(DialogService);
app.use(store);

app.directive('ripple', Ripple);

//primevue components
app.component('Toast', Toast);
app.component('prime-image', Image);
app.component('prime-card', Card);
app.component('Dialod',Dialog);
app.component('prime-button', Button);
app.component('fontAwesomeIcon', FontAwesomeIcon);
export default app;