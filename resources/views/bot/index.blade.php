@extends('layouts.app')
@push('vite-resources-js')
    @vite(['resources/js/components/bot/bot-app.js'])
@endpush
@section('layout-topbar')
        <navbar-component :authenticated="{{ Auth::check() ? 'true' : 'false' }}"  token = "{{ csrf_token() }}"></navbar-component>
@endsection
@section('layout-content')
        <bot-component registers="{{json_encode($records)}}" ></bot-component>
@endsection
