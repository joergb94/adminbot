@extends('layouts.app-auth')
@push('vite-resources-js')
@vite(['resources/js/components/register/register-app.js'])
@endpush
@section('layout-topbar')
@endsection
@section('layout-content')
<div  class="flex justify-content-center flex-wrap">
    <register-form-component></register-form-component>
</div>
@endsection