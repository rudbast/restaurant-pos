@extends('layouts.dashboard')

@section('title', 'Home')

@section('module-category', 'Halaman Utama')

@section('sidemenu')
    @include('partials.sidemenu', [
        'menu' => '',
        'submenu' => ''
    ])
@endsection
