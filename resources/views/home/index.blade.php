@extends('layouts.app')
@push('vite-resources-js')
    @vite(['resources/js/components/home/home-app.js'])
@endpush
@section('layout-topbar')
    <navbar-component :authenticated="{{ Auth::check() ? 'true' : 'false' }}"  token = "{{ csrf_token() }}"></navbar-component>
@endsection
@section('layout-content')
        <home-component :user="{{$user}}" :bots="{{$bots}}" ></home-component>
@endsection

