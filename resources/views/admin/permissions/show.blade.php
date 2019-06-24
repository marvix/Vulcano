@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes de uma permissão
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>

    <li>
        <a href="{{ route('permissions.index') }}">Lista de Permissões</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('permissions.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-2'>Nome da Permissão</td>
                    <td class='col-sm-10'>{{ $permission->name }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Descrição</td>
                    <td class='col-sm-10'>{{ $permission->description }}</td>
                </tr>


                <tr>
                    <td class='col-sm-2'>Criado em</td>
                    <td class='col-sm-10'>
                        @if(null != $permission->created_at)
                        {{ $permission->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Atualizado em</td>
                    <td class='col-sm-10'>
                        @if (null != $permission->updated_at)
                        {{ $permission->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('permissions.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
