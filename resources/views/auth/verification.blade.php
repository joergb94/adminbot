@extends('layouts.app')
@push('vite-resources-js')
@vite(['resources/js/components/verification/verification-app.js'])
@endpush
@section('layout-content')
<div class="grid justify-content-center flex-wrap">
    <prime-card class="mt-5 w-8">
        <template #title>
            <div class="flex flex-wrap align-items-center mb-3 gap-2">
                <div class="grid">
                        <div class="sm:col-2 lg:col-2 xl:col-2">
                            <prime-image src="/assets/logo.png" class="mt-2" alt="Image" width="32" />
                        </div>
                        <div class="sm:col-10 lg:col-10 xl:col-10"> <h4 class="mt-2 ml-4">Cuenta de facturación verificada</h4></div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
        <verification-card-component></verification-card-component>
        </template>
    </prime-card>
</div>
@endsection