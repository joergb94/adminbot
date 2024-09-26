@extends('layouts.app')
@push('vite-resources-js')
@vite(['resources/js/components/errors/error-app.js'])
@endpush
@section('layout-topbar')
<navbar-component :authenticated="{{ Auth::check() ? 'true' : 'false' }}"  token = "{{ csrf_token() }}"></navbar-component>
@endsection
@section('layout-content')
    <error-page-component title="404" subtitle="La pagina que quieres acceder no se encuentra disponible"></error-page-component>
@endsection