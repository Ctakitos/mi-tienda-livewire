@extends('components.layouts.app')

@section('title', 'Página de Frontend')

@section('content')
    @livewire('navbar')
    @livewire('banner-section')
    @livewire('product-section')
    @livewire('service-section')
@endsection


