@extends('components.layouts.app')

@section('title', 'Gestión de Servicios')

@section('content')
    @livewire('navbar')
    @livewire('dashboard.service-manager')
@endsection
