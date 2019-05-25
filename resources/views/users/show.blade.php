@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do usuário
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}">Dashboard</a>
    </li>

    <li>
        <a href="{{ route('users.index') }}">Lista de Usuários</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('users.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-2'>ID</td>
                    <td class='col-sm-10'>{{ $user->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Nome do Usuário</td>
                    <td class='col-sm-10'>{{ $user->name }}</td>
                </tr>

                <tr>
                    <td class="col-sm-2">Gênero</td>
                    <td class="col-sm-10">
                        @if($user->gender == "N") Preferiu não responder @endif
                        @if($user->gender == "M") Masculino @endif
                        @if($user->gender == "F") Feminino @endif
                    </td>
                </tr>

                <tr>
                    <td class="col-sm-2">Administrador?</td>
                    <td class="col-sm-10">
                        @if($user->isAdmin)<span class="label label-success">Sim</span>@endif
                        @if(!$user->isAdmin)<span class="label label-danger">Não</span> @endif
                    </td>
                </tr>

                <tr>
                    <td class="col-sm-2">Ativo?</td>
                    <td class="col-sm-10">
                        @if($user->active)<span class="label label-success">Sim</span>@endif
                        @if(!$user->active)<span class="label label-danger">Não</span>@endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>E-mail</td>
                    <td class='col-sm-10'>{{ $user->email }}</td>
                </tr>

                <tr>
                    <td class="col-sm-2" style="vertical-align:middle">Avatar</td>
                    <td class="col-sm-10">
                        @if($avatar != "")
                        <img src="{{ asset($avatar) }}" width="50px" alt="avatar" class="img-circle">
                        @php $canDeleteAvatar = true; @endphp
                        @elseif(Gravatar::exists($user->email))
                        <img src="{{ Gravatar::get($user->email) }}" width="50px" alt="avatar" class="img-circle">
                        @else
                        <img src="{{ asset('img/avatar/no-photo.png') }}" width="50px" alt="avatar" class="img-circle">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class='col-sm-2'>Data de Criação</td>
                    <td class='col-sm-10'>
                        @if(null != $user->created_at)
                        {{ $user->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Data da Última Atualização</td>
                    <td class='col-sm-10'>
                        @if (null != $user->updated_at)
                        {{ $user->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('users.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
