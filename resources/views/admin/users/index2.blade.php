@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Lista de Usuários
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Lista de Usuários</li>
</ol>

@stop

@section('content')
<div class="row">
    @widget('admins_widget')
    @widget('users_widget')
    @widget('users_actives_widget')
    @widget('users_inactives_widget')
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar usuários -->
        <div class="pull-right">
            <a class="btn btn-info btn-sm" href="{{ route('users.index') }}">
                <i class="glyphicon glyphicon-refresh"></i> Atualizar a Tela
            </a>

            @if(Auth::user()->hasPermission('users_create'))
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
            @endif
        </div>

        <h5>Relação de Usuários do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th class='text-center'>Papel</th>
                    <th class='text-center'>Super Admin?</th>
                    <th class='text-center'>Ativo?</th>
                    <th class='text-center'>Avatar</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>

</div>
@stop

@section('js')
<!-- <script src="{{ asset('vendor/vulcano/js/users.js') }}"></script> -->
<script>
@include('admin.assets.js.users')
</script>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/vulcano/css/users.css') }}">
@stop
