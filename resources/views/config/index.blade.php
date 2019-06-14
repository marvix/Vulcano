@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Configurações do Sistema
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Configurações</li>
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

            @can('config_create')
            <a class="btn btn-success btn-sm" href="{{ route('config.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
        </div>
        @endcan

        <h5>Relação de Configurações do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-configuracao">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Chave</th>
                    <th>Slug</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($config as $key => $c)
                <tr>
                    <!-- id -->
                    <td>{{ $c->id }}</td>

                    <!-- key -->
                    <td>{{ $c->key }}</td>

                    <!-- slug -->
                    <td>{{ $c->slug_key }}</td>

                    <!-- value -->
                    <td>{{ $c->value }}</td>

                    <!-- type -->
                    <td>
                        @if ($c->type == "integer") Inteiro @endif
                        @if ($c->type == "float") Real @endif
                        @if ($c->type == "money") Monetário @endif
                        @if ($c->type == "string") Texto @endif
                        @if ($c->type == "boolean") Lógico @endif
                        @if ($c->type == "date") Data @endif
                        @if ($c->type == "datetime") Data/Hora @endif
                        @if ($c->type == "time") Hora @endif
                    </td>

                    <!-- description -->
                    <td>{{ $c->description }}</td>

                    <!-- ações -->
                    <td style="width:75px;">
                        @if(Auth::user()->hasRole('Super Admin'))
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("config.show", $c->id) }}' role='button' alt="Visualiza os dados da configuração" title="Visualiza os dados da configuração">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasRole('Super Admin'))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("config.edit", $c->id)}}' role='button' alt="Edita os dados desta configuração" title="Edita os dados desta configuração">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasRole('Super Admin'))
                        <!-- exclusão do registro -->

                        @php $rota = route("config.delete", $c->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este registro" href="javascript:;" onclick="deleteConfig('{{ $rota }}');" role="button" alt="Exclui esta configuração" title="Exclui esta configuração">
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
        {{ $config->links()  }}
    </div>

</div>
@stop

@section('js')
<script src="{{ asset('vendor/vulcan/js/config.js') }}"></script>
@stop
