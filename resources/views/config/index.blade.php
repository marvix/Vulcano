@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Parâmetros do Sistema
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Parâmetros do Sistema</li>
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
    <br />{{ session('message') }}
</div>
@endif

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar configurações -->
        <div class="pull-right">
            <a class="btn btn-info btn-sm" href="{{ route('config.index') }}">
                <i class="glyphicon glyphicon-refresh"></i> Atualizar a Tela
            </a>

            @if(Auth::user()->hasPermission('config_create'))
            <a class="btn btn-success btn-sm" href="{{ route('config.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
            @endif
        </div>

        <h5>Relação de Parâmetros do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-config">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ordem</th>
                    <th>Chave</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>DataEnum</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($configs as $key => $c)
                <tr>
                    <!-- id -->
                    <td>{{ $c->id }}</td>

                    <!-- order -->
                    <td>{{ $c->order }}</td>

                    <!-- key -->
                    <td>{{ $c->key }}</td>

                    <!-- description -->
                    <td>{{ $c->description }}</td>

                    <!-- type -->
                    <td>
                        @if($c->type == "text") Texto @endif
                        @if($c->type == "integer") Número @endif
                    </td>

                    <!-- dataenum -->
                    <td>{{ $c->dataenum }}</td>

                    <!-- ações -->
                    <td style="width:110px;">
                        @if(Auth::user()->hasPermission('config_show'))
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("config.show", $c->id) }}' role='button' alt="Visualiza detalhes do parâmetro" title="Visualiza detalhes do parâmetro">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('config_edit'))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("config.edit", $c->id)}}' role='button' alt="Edita os dados do parâmetro" title="Edita os dados do parâmetro">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('config_delete'))
                        <!-- exclusão do registro -->

                        @php $rota = route("config.delete", $c->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este parâmetro" href="javascript:;" onclick="deleteConfig('{{ $rota }}');" role="button" alt="Exclui este parâmetro">
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
        {{ $configs->links()  }}
    </div>

</div>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/configs.js') }}"></script>
@stop
