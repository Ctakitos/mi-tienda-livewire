@extends('components.layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
    @livewire('navbar')
    @livewire('dashboard.product-manager')
@endsection