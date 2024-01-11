@extends('layouts.profile')

@section('title')
    ExciteExpedition | Profile
@endsection

@section('sidebar')
    @include('includes.sidebar', ['activeNav' => $activeNav ])
@endsection

@section('content')
    @yield('optionContent')
@endsection
