<script setup>
    const props = defineProps({
        user : Array,
        bots: Number
    });
    const user = props.user;
    const bots = props.bots;
</script>

<template>
        <Card class="col-sm-6 mt-5 neo-background  text-center">
            <template #header>
                <div class="col-12">
                    <img alt="user header" src="/assets/logo-name.png"  width="80%"  />
                </div>
            </template>
            <template #title>
                <h3 class="neo-text-purple" v-text="'¡Bienvenido '+user.name+' '+user.last_name+'!'"></h3>
            </template>
            <template #content>
                <h2 v-if="bots == 0"  ><fontAwesomeIcon icon="fa fa-triangle-exclamation" class="mr-1 text-yellow-500" />Vaya, no cuentas aún con ningun bot.</h2>
                <h4 v-if="bots == 0" >Dirígete a <a href="/bots" class="text-yellow-500 text-underline">Mis Boots</a> para crea el primero.</h4>
            </template>
        </Card>
</template>