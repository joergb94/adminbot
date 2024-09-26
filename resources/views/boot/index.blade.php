@extends('layouts.app')
@push('vite-resources-js')
    @vite(['resources/js/components/entity/entity-app.js'])
@endpush
@section('layout-topbar')
        <navbar-component :authenticated="{{ Auth::check() ? 'true' : 'false' }}"  token = "{{ csrf_token() }}"></navbar-component>
@endsection
@section('layout-content')
        <entity-component registers="{{json_encode($records)}}" ></entity-component>
@endsection
