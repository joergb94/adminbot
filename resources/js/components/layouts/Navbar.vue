<script setup>
import { ref , onMounted, watch } from 'vue';
import Menubar from 'primevue/menubar';
import Menu from 'primevue/menu';
import Button from 'primevue/button';
import Image from 'primevue/image'
import ButtonGroup from 'primevue/buttongroup';

const props = defineProps({
  authenticated: Boolean,
  token : String
});
const logoutForm = ref(null);
const menu = ref();
const logout = () => {
      event.preventDefault();
      logoutForm.value.submit();
    };
const toggle = (event) => {
    menu.value.toggle(event);
};

const authenticated = props.authenticated;
const token = props.token;
const items = ref([]);

const itemsAuthenticated = ref([
    {
        label: 'Home',
        icon: 'pi pi-home',
        url:'/inicio'
    },
    {
        label: 'Bots',
        icon: 'pi pi-comments',
        url:'/bots'
    },

]);


const handleMenu = () =>{
    return authenticated == true? itemsAuthenticated.value:[]
}
onMounted(() => { items.value = handleMenu()});
</script>
<template>
        <Menubar class="background-black" :model="items">
            <template #start>
                    <Image src="/assets/logo-name.png" alt="Image" width="150" style="margin: 0;" class="mr-5"/>
            </template>
            <template #item="{ item, props, hasSubmenu, root }">
                <a v-ripple :href="item.url"  v-bind="props.action" >
                    <span>
                        <PrimeIconComponent :icon="item.icon" :color="'neo-text-purple'" :label ="item.label"/>
                    </span> 
                </a>
                </template>
            <template #end="{ props }">
                <ButtonGroup>
                    <Button  
                        class="button-navbar text-white" 
                        type="button" >
                        <i class="text-white pi pi-question-circle"></i>
                    </Button>
                    <Button
                        v-if="authenticated"  
                        style="border-left: 2px solid whitesmoke !important;"
                        class="button-navbar text-white" 
                        type="button" 
                        @click="toggle" 
                        outlined
                        aria-haspopup="true" 
                        aria-controls="overlay_menu" >
                        <i class="text-white pi pi-cog"></i>
                        <i class="text-white pi pi-user"></i>
                    </Button>
                </ButtonGroup>
               
                <Menu ref="menu" id="overlay_menu" :popup="true" >
                    <template #start>
                        <span class="inline-flex align-items-center gap-1 px-2 py-2">
                            <span class="text-ml font-semibold">Configuaciones de usuario</span>
                        </span>
                    </template>
        
                    <template #end v-if="authenticated">
                      <div  class="flex align-items-center  text-center gap-2">
                        <form ref="logoutForm" action="/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="token">
                        </form>
                        <div class="col-12 text-center">
                            <a href="#" @click="logout">  
                                <span>
                                    Salir   <fontAwesomeIcon icon="fa-solid fa-right-from-bracket" class="mr-1 text-primary-700" />
                                </span>
                            </a>
                        </div>
                    
                    </div>
                    </template>
                </Menu>
            </template>
        </Menubar>
</template>