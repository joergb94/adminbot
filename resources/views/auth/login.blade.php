@extends('layouts.app-auth')
@push('vite-resources-js')
    @vite(['resources/js/components/login/login-app.js'])
@endpush
@section('layout-topbar')

@endsection
@section('layout-content')
    <div class="flex justify-content-center flex-wrap">
        <login-form-component></login-form-component>
    </div>
@endsection
