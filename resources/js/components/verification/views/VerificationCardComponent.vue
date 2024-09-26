<script setup>
    const onReload =() => {
            window.location.href = "/cliente/inicio";
    };
</script>
<template>
    <div class="grid justify-content-center flex-wrap">
        <div class="sm:col-10 lg:col-10 xl:col-10 text-center">
        <h3>Ahora ya puedes continuar navegando con nosotros.</h3>
        <h5>Muchas gracias.</h5>
        <h6>DAYTECH Mexico.</h6>
        </div>
        <div class="col-12">
            <div class="text-center mb-2">
                <prime-button type="button" label="Continuar Navegando" severity="info" @click="onReload"/>
            </div>
        </div>
    </div>
</template>
