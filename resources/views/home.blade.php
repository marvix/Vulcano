@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-dashboard'></i> Dashboard
</span>

<ol class="breadcrumb">
    <li class="active">
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
</ol>

@stop

@section('content')
<!-- <div class="jumbotron text-center bg-gray">
    <div class="container">
        <img src="{{ asset('img/logos/logo.png') }}" width="70px" ;alt="Vulcano">
        <h2>Bem vindo</h2>
        <h3>Você agora está logado no sistema!!</h3>
    </div>
</div> -->

<div class="row">
        @widget('users_widget')
</div>
@stop
