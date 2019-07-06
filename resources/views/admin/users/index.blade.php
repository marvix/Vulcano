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
                @foreach($users as $key => $user)
                <tr>
                    <!-- id -->
                    <td>{{ $user->id }}</td>

                    <!-- name -->
                    <td>{{ $user->name }}</td>

                    <!-- e-mail -->
                    <td>{{ $user->email }}</td>

                    <!-- roles -->
                    <td class="text-center">
                        @foreach($users[$key]->roles as $role)
                        {{ $role->description }}
                        @endforeach
                    </td>

                    <!-- super admin -->
                    <td class="text-center">
                        @if($user->isSuperAdmin())
                        <a class="label label-success">Sim</a>
                        @else
                        Não
                        @endif
                    </td>
                    <!-- active -->
                    <td class="text-center">
                        @if($user->active)
                        <span class="label label-success">Sim</span>
                        @else
                        <span class="label label-danger">Não</span>
                        @endif
                    </td>

                    <!-- avatar -->
                    <td class="text-center">
                        @php
                        $avatar = $user->getFirstMediaUrl('avatars');
                        @endphp

                        @if($avatar)
                        <img src="{{ $avatar }}" class="img-circle" style="width:24px;" alt="avatar">
                        @elseif(Gravatar::exists($user->email))
                        <img src="{{ Gravatar::get($user->email) }}" class="img-circle" style="width:24px;">
                        @else
                        <img src="{{ asset('img/avatar/no-photo.png') }}" class="img-circle" style="width:24px;">
                        @endif
                    </td>

                    <!-- ações -->
                    <td style="width:100px;">
                        @if(Auth::user()->hasPermission('users_show') && !$user->isSuperAdmin())
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("users.show", $user->id) }}' role='button' alt="Visualiza os dados do usuário" title="Visualiza os dados do usuário">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('users_edit') && (Auth::user()->id != $user->id && !$user->isSuperAdmin()))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("users.edit", $user->id)}}' role='button' alt="Edita os dados do usuário" title="Edita os dados do usuário">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('users_delete') && (Auth::user()->id != $user->id && !$user->isSuperAdmin()))
                        <!-- exclusão do registro -->

                        @php $rota = route("users.delete", $user->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este registro" href="javascript:;" onclick="deleteUser('{{ $rota }}');" role="button" alt="Exclui este usuário" title="Exclui este usuário">
                            <i class="fa fa-trash"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class=" panel-footer">
        {{ $users->links()  }}
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
