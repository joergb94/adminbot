@extends('errors::minimal')
@push('vite-resources-js')
        @vite(['resources/js/components/erros/error-app.js'])
    @endpush
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __())

@extends('layouts.app')
@push('vite-resources-js')
@vite(['resources/js/components/errors/error-app.js'])
@endpush
@section('layout-topbar')
<navbar-component :authenticated="{{ Auth::check() ? 'true' : 'false' }}"  token = "{{ csrf_token() }}"></navbar-component>
@endsection
@section('layout-content')
<div class="grid justify-content-center flex-wrap">
    <prime-card class="mt-5 w-8">
        <template #title>
            <div class="flex flex-wrap align-items-center mb-3 gap-2">
                <div class="grid justify-content-center flex-wrap">
                            <prime-image src="/assets/logo-name.png" class="mt-2 ml-2 mr-2" alt="Image" width="100%" />
                    </div>
            </div>
        </template>
        <template #content>
            <error-page-component title="403" subtitle="{{$exception->getMessage() ?: 'Prohibido'}}"></error-page-component>
        </template>
    </prime-card>
</div>
@endsection