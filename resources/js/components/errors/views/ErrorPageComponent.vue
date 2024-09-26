<script setup>
  const props = defineProps({
        title : String,
        subtitle: String
    });
    const title = props.title;
    const subtitle = props.subtitle;
    const onReload =() => {
            window.location.href = "/inicio";
    };
</script>
<template>
    <div  class="grid justify-content-center flex-wrap">
            <prime-card class="w-8 neo-background ">
                <template #title>
                    <div class="flex flex-wrap align-items-center mb-3 gap-2">
                        <div class="grid justify-content-center flex-wrap text-center">
                                <prime-image src="/assets/logo-error.png" class="mt-2" alt="Image" width="50%" />
                        </div>
                    </div>
                </template>
                <template #content>
                    <div class="grid justify-content-center flex-wrap">
                        <div class="sm:col-10 lg:col-10 xl:col-10 text-center">
                        <h1 v-text="'Error '+title"></h1>
                        <h5 v-text ="subtitle"></h5>
                        <h6>by FlexDialog.</h6>
                        </div>
                        <div class="col-12">
                            <div class="text-center mb-2">
                                <prime-button type="button" label="Continuar Navegando" severity="info" @click="onReload"/>
                            </div>
                        </div>
                    </div>
                </template>
            </prime-card>
    </div>
</template>
