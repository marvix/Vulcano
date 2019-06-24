@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Permissões do Sistema
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Permissões do Sistema</li>
</ol>

@stop

@section('content')
<div class="row">
    @widget('permissions_widget')
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar configurações -->
        <div class="pull-right">
            <a class="btn btn-info btn-sm" href="{{ route('permissions.index') }}">
                <i class="glyphicon glyphicon-refresh"></i> Atualizar a Tela
            </a>

            @if(Auth::user()->hasPermission('permissions_create'))
            <a class="btn btn-success btn-sm" href="{{ route('permissions.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
            @endif
        </div>

        <h5>Relação de Permissões do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-permissions">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Permissão</th>
                    <th>Descrição</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($permissions as $key => $p)
                <tr>
                    <!-- id -->
                    <td>{{ $p->id }}</td>

                    <!-- name -->
                    <td>{{ $p->name }}</td>

                    <!-- description -->
                    <td>{{ $p->description }}</td>

                    <!-- ações -->
                    <td style="width:100px;">
                        @if(Auth::user()->hasPermission('permissions_show'))
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("permissions.show", $p->id) }}' role='button' alt="Visualiza os detalhes da permissão" title="Visualiza os detalhes da permissão">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                       @if(Auth::user()->hasPermission('permissions_edit'))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("permissions.edit", $p->id)}}' role='button' alt="Edita os dados da permissão" title="Edita os dados da permissão">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('permissions_delete'))
                        <!-- exclusão do registro -->

                        @php $rota = route("permissions.delete", $p->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este registro" href="javascript:;" onclick="deletePermission('{{ $rota }}');" role="button" alt="Exclui esta permissão" title="Exclui esta permissão">
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
        {{ $permissions->links()  }}
    </div>

</div>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/permissions.js') }}"></script>
@stop
