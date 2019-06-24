@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Módulos do Sistema
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Módulos do Sistema</li>
</ol>

@stop

@section('content')
<div class="row">
    @widget('modules_widget')
</div>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar -->
        <div class="pull-right">
            <a class="btn btn-info btn-sm" href="{{ route('modules.index') }}">
                <i class="glyphicon glyphicon-refresh"></i> Atualizar a Tela
            </a>

            @if(Auth::user()->hasPermission('modules_create'))
            <a class="btn btn-success btn-sm" href="{{ route('modules.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
            @endif
        </div>

        <h5>Relação de Módulos do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-modules">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prefixo</th>
                    <th>Descrição</th>
                    <td>Direitos</td>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($modules as $key => $m)
                <tr>
                    <!-- id -->
                    <td>{{ $m->id }}</td>

                    <!-- prefix -->
                    <td>{{ $m->prefix }}</td>

                    <!-- description -->
                    <td>{{ $m->description }}</td>

                    <!-- access -->
                    <td>
                        @if(strpos($m->access, "A") !== false)
                        <span class="label label-info">Acessar</span>
                        @endif

                        @if(strpos($m->access, "C") !== false)
                        <span class="label label-success">Criar</span>
                        @endif

                        @if(strpos($m->access, "R") !== false)
                        <span class="label label-primary">Ler</span>
                        @endif

                        @if(strpos($m->access, "U") !== false)
                        <span class="label label-warning">Editar</span>
                        @endif

                        @if(strpos($m->access, "D") !== false)
                        <span class="label label-danger">Excluir</span>
                        @endif

                    </td>

                    <!-- ações -->
                    <td style="width:100px;">
                        @if(Auth::user()->hasPermission('modules_show'))
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("modules.show", $m->id) }}' role='button' alt="Visualiza os detalhes do módulo" title="Visualiza os detalhes do módulo">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('modules_edit'))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("modules.edit", $m->id)}}' role='button' alt="Edita os dados do módulo" title="Edita os dados do módulo">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('modules_delete'))
                        <!-- exclusão do registro -->

                        @php $rota = route("modules.delete", $m->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este registro" href="javascript:;" onclick="deleteModule('{{ $rota }}');" role="button" alt="Exclui este módulo" title="Exclui este módulo">
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
        {{ $modules->links()  }}
    </div>

</div>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/modules.js') }}"></script>
@stop
