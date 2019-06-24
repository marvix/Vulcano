@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do módulo
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>

    <li>
        <a href="{{ route('modules.index') }}">Lista de Módulos</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('modules.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-2'>ID</td>
                    <td class="col-sm-10">{{ $module->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Prefixo</td>
                    <td class='col-sm-10'>{{ $module->prefix }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Descrição</td>
                    <td class='col-sm-10'>{{ $module->description }}</td>
                </tr>

                <tr>
                    <td class="col-sm-2">Direitos</td>
                    <td class="col-sm-10">
                        @if(strpos($module->access, "A") !== false)
                        <span class="label label-info">Acessar</span>
                        @endif

                        @if(strpos($module->access, "C") !== false)
                        <span class="label label-success">Criar</span>
                        @endif

                        @if(strpos($module->access, "R") !== false)
                        <span class="label label-primary">Ler</span>
                        @endif

                        @if(strpos($module->access, "U") !== false)
                        <span class="label label-warning">Editar</span>
                        @endif

                        @if(strpos($module->access, "D") !== false)
                        <span class="label label-danger">Excluir</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Criado em</td>
                    <td class='col-sm-10'>
                        @if(null != $module->created_at)
                        {{ $module->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Atualizado em</td>
                    <td class='col-sm-10'>
                        @if (null != $module->updated_at)
                        {{ $module->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('modules.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
