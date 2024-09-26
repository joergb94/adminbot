<script setup>
  const props = defineProps({
        title : String,
        subtitle: String
    });
    const title = props.title;
    const subtitle = props.subtitle;
    const onReload =() => {
            window.location.href = "/cliente/inicio";
    };
</script>
<template>
    <div class="grid justify-content-center flex-wrap">
        <div class="sm:col-10 lg:col-10 xl:col-10 text-center">
        <h1 v-text="'Error '+title"></h1>
        <h5 v-text ="subtitle"></h5>
        <h6>DAYTECH Mexico.</h6>
        </div>
        <div class="col-12">
            <div class="text-center mb-2">
                <prime-button type="button" label="Continuar Navegando" severity="info" @click="onReload"/>
            </div>
        </div>
    </div>
</template>
