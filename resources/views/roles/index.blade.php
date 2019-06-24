@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Papéis do Sistema
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Papéis do Sistema</li>
</ol>

@stop

@section('content')

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading clearfix">

        <!-- somente administradores podem cadastrar configurações -->
        <div class="pull-right">
            <a class="btn btn-info btn-sm" href="{{ route('roles.index') }}">
                <i class="glyphicon glyphicon-refresh"></i> Atualizar a Tela
            </a>

            @if(Auth::user()->hasPermission('roles_create'))
            <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}">
                <i class="fa fa-plus"></i> Inserir um novo registro
            </a>
            @endif
        </div>

        <h5>Relação de Papéis do Sistema</h5>
    </div>

    <div class="panel-body">
        <!-- Table -->
        <table class="table table-striped table-bordered table-hover table-responsive" id="table-roles">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Papel</th>
                    <th>Descrição</th>
                    <th>Super Admin?</th>
                    <th class='text-center'>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $key => $r)
                <tr>
                    <!-- id -->
                    <td>{{ $r->id }}</td>

                    <!-- name -->
                    <td>{{ $r->name }}</td>

                    <!-- description -->
                    <td>{{ $r->description }}</td>

                    <!-- is_superadmin -->
                    <td>
                        @if($r->is_superadmin)
                        <span class="label label-success">Sim</span>
                        @else
                        Não
                        @endif
                    </td>

                    <!-- ações -->
                    <td style="width:110px;">
                        @if(Auth::user()->hasPermission('roles_show'))
                        <!-- visualização de dados-->
                        <a class='btn btn-info btn-xs' style="float:left; margin-right: 2px;" href='{{ route("roles.show", $r->id) }}' role='button' alt="Visualiza os detalhes do papel" title="Visualiza os detalhes do papel">
                            <i class='fa fa-eye'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('roles_edit'))
                        <!-- edição de dados -->
                        <a class='btn btn-warning btn-xs' style="float:left;margin-right: 2px;" href='{{ route("roles.edit", $r->id)}}' role='button' alt="Edita os dados do papel" title="Edita os dados do papel">
                            <i class='fa fa-pencil'></i>
                        </a>
                        @endif

                        @if(Auth::user()->hasPermission('roles_delete'))
                        <!-- exclusão do registro -->

                        @php $rota = route("roles.delete", $r->id); @endphp

                        <a class="btn btn-xs btn-danger" style="float:left;margin-right: 2px;" title="Excluir este registro" href="javascript:;" onclick="deleteRole('{{ $rota }}');" role="button" alt="Exclui este papel" title="Exclui este papel">
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
        {{ $roles->links()  }}
    </div>

</div>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/roles.js') }}"></script>
@stop
