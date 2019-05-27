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
<span class="text-bold">Você agora está logado no sistema!!</span>
@stop
