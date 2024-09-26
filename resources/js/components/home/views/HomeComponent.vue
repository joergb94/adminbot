<script setup>
    const props = defineProps({
        user : Array,
        entity: Number
    });
    const user = props.user;
    const entity = props.entity;
</script>

<template>
        <Card class="col-sm-6 text-center">
            <template #header>
                <div class="col-12">
                    <img alt="user header" src="/assets/logo-name.png"  width="100%"  />
                </div>
            </template>
            <template #title>
                <h2>Bienvenido</h2>
            </template>
            <template #subtitle v-if="user"> 
                <h4 v-text="user.name+' '+user.first_name+' '+user.last_name"></h4>
            </template>
            <template #content>
                <h2 v-if="entity == 0"  ><fontAwesomeIcon icon="fa fa-triangle-exclamation" class="mr-1 text-yellow-500" />Vaya, no cuentas aún con ninguna empresa.</h2>

                <h4 v-if="entity == 0" >Dirígete a <a href="/boots" class="text-yellow-500">Mis Boots</a> para registrar las empresas que necesites facturar</h4>
            </template>
        </Card>
</template>