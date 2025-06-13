@extends('components.layouts.app')

@section('title', 'Gestión de Banners')

@section('content')
    @livewire('navbar')
    @livewire('dashboard.banner-manager')
@endsection
