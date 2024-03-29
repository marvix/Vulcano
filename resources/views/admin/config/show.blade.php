@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do parâmetro
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>

    <li>
        <a href="{{ route('config.index') }}">Parâmetro do Sistema</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('config.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-2'>ID</td>
                    <td class='col-sm-10'>{{ $config->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Ordem</td>
                    <td class='col-sm-10'>{{ $config->order }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Chave</td>
                    <td class='col-sm-10'>{{ $config->key }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Slug</td>
                    <td class='col-sm-10'>{{ $config->slug_key }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Descrição</td>
                    <td class='col-sm-10'>{{ $config->description }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Tipo</td>
                    <td class='col-sm-10'>{{ $config->type }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>DataEnum</td>
                    <td class='col-sm-10'>{{ $config->dataenum }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Valor</td>
                    <td class='col-sm-10'>{{ $config->value }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Criado em</td>
                    <td class='col-sm-10'>
                        @if(null != $config->created_at)
                        {{ $config->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Atualizado em</td>
                    <td class='col-sm-10'>
                        @if (null != $config->updated_at)
                        {{ $config->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('config.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
