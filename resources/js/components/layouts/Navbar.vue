<script setup>
import { ref , onMounted} from 'vue';
import Menubar from 'primevue/menubar';
import Image from 'primevue/image'
import Dock from 'primevue/dock';
const props = defineProps({
  authenticated: Boolean,
  token : String
});
const logoutForm = ref(null);

const logout = () => {
      event.preventDefault();
      logoutForm.value.submit();
    };

const authenticated = props.authenticated;
const token = props.token;
const items = ref([]);

const itemsAuthenticated = ref([
    {
        label: 'Home',
        icon: 'fa fa-home',
        url:'/cliente/inicio'
    },
    {
        label: 'Mis Empresas',
        icon: 'fa fa-address-book',
        url:'/cliente/empresas'
    },
    {
        label: 'Generar Facturas',
        icon: 'fa fa-file-invoice-dollar',
        url:'/cliente/facturacion'
    },
    {
        label: 'Mis Facturas',
        icon: 'fa fa-wallet',
        url:'/cliente/facturas'
    },
]);


const handleMenu = () =>{
    return authenticated == true? itemsAuthenticated.value:items.value
}
onMounted(() => { items.value = handleMenu()});
</script>
<template>
        <Menubar class="custom-menubar" :model="items">
            <template #start>
                    <Image src="/assets/logo-name.png" alt="Image" width="150" style="margin: 0;" class="mr-5"/>
            </template>
            <template #item="{ item, props, hasSubmenu, root }">
                <a v-ripple :href="item.url" :target="item.target" v-bind="props.action" class="ml-5">
                    <span>
                        <fontAwesomeIcon :icon="item.icon" class="mr-1 text-primary-00" />{{ item.label }}
                    </span> 
                </a>
                </template>

            <template #end="{ props }">
                
              
                <div v-if="authenticated" class="flex align-items-center gap-2">
                    <form ref="logoutForm" action="/logout" method="POST" style="display: none;">
                        <input type="hidden" name="_token" :value="token">
                    </form>
                    <a href="#" @click="logout">  
                        <span>
                            Salir   <fontAwesomeIcon icon="fa-solid fa-right-from-bracket" class="mr-1 text-primary-700" />
                        </span>
                    </a>
                </div>
            </template>
        </Menubar>
        
</template>