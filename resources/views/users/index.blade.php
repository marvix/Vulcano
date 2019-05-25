@extends('adminlte::page')

@section('title', config('adminlte.title'))
<meta name="csrf_token" content="{{ csrf_token() }}" />

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Lista de Usuários
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="active">Lista de Usuários</li>
</ol>

@stop

@section('content')

@if (session('message'))
    <div class="alert alert-{{ session('type') }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if(session('type') == 'success')
        <span style="font-size:24px;">Eba!!!</span>
        @else
        <span style="font-size:24px;">Whops!!!</span>
        @endif
        <br/>{{ session('message') }}
    </div>
@endif

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar usuários -->
        @if(Auth::user()->isAdmin)
        <div class="btn-group pull-right">
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
        </div>
        @endif

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
                    <th class='text-center'>Administrador?</th>
                    <th class='text-center'>Ativo?</th>
                    <th class='text-center'>Avatar</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if($user->isAdmin)
                        <span class="label label-success">Sim</span>
                        @else
                        <span class="label label-danger">Não</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($user->active)
                        <span class="label label-success">Sim</span>
                        @else
                        <span class="label label-danger">Não</span>
                        @endif
                    </td>
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
                    <td style="width:155px;">
                        @if(Auth::user()->isAdmin)
                            @if (Auth::user()->id != $user->id)
                                <!-- ativar o usuário -->
                                @if(!$user->active)
                                <a class='btn btn-active btn-sm' style="float:left; margin-right: 2px;"
                                href='{{ route("users.active", $user->id) }}' role='button' alt="Ativa o usuário" title="Ativa o usuário">
                                    <i class='fa fa-toggle-off'></i>
                                </a>
                                @else
                                <!-- desativar o usuário -->
                                <a class='btn btn-desactive btn-sm' style="float:left; margin-right: 2px;"
                                href='{{ route("users.desactive", $user->id) }}' role='button' alt="Desativa o usuário" title="Desativa o usuário">
                                    <i class='fa fa-toggle-on'></i>
                                </a>
                                @endif
                            @endif
                        @endif

                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-sm' style="float:left; margin-right: 2px;"
                           href='{{ route("users.show", $user->id) }}' role='button' alt="Visualiza os dados do usuário" title="Visualiza os dados do usuário">
                            <i class='fa fa-eye'></i>
                        </a>

                        <!-- somente administradores podem editar e/ou excluir usuários -->
                        @if(Auth::user()->isAdmin)

                            <!-- o usuário não pode se editar e nem se excluir -->
                            @if (Auth::user()->id != $user->id)
                            <!-- edição de dados -->
                            <a class='btn btn-warning btn-sm'  style="float:left;margin-right: 2px;"
                            href='{{ route("users.edit", $user->id) }}' role='button' alt="Edita os dados do usuário" title="Edita os dados do usuário">
                                <i class='fa fa-pencil'></i>
                            </a>

                            <!-- exclusão do registro -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <button type='submit' class='btn btn-danger btn-sm'  style="float:left" alt="Exclui o usuário" title="Exclui o usuário">
                                    <i class='fa fa-trash'></i>
                                </button>
                            </form>
                            @endif

                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        {{ $users->links()  }}
    </div>

</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#table-usuarios').DataTable(
        {
            "paging": false,
            "info": false,
            "searching": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "processing": true,
        }
    );
});
</script>
@stop

@section('css')
    <style>
    .btn-active {
        background-color: #32cd32;
        color: #fff;
    }

    .btn-active:hover {
        background-color: #30b730;
        color: #fff;
    }

    .btn-desactive {
        background-color: #0065ff;
        color: #fff;
    }

    .btn-desactive:hover {
        background-color: #00f;
        color: #fff;
    }

    </style>
@stop
