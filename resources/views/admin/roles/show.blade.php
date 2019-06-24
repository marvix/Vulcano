@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<h1>
    <i class='fa fa-database'></i> Exibindo os detalhes do papel
</h1>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>

    <li>
        <a href="{{ route('roles.index') }}">Papéis</a>
    </li>

    <li class="active">Exibindo dados</li>
</ol>
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <span>
            <a class='' href='{{ route('roles.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <tbody>
                <tr>
                    <td class='col-sm-2'>ID</td>
                    <td class='col-sm-10'>{{ $role->id }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Nome do papel</td>
                    <td class='col-sm-10'>{{ $role->name }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>É Super Administrador?</td>
                    <td class='col-sm-10'>
                        @if($role->is_superadmin)
                        <span class="label label-success">Sim</span>
                        @else
                        <span class="label label-danger">Não</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="col-sm-2">Descrição</td>
                    <td class='col-sm-10'>{{ $role->description }}</td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Criado em</td>
                    <td class='col-sm-10'>
                        @if(null != $role->created_at)
                        {{ $role->created_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class='col-sm-2'>Atualizado em</td>
                    <td class='col-sm-10'>
                        @if (null != $role->updated_at)
                        {{ $role->updated_at->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        @if(!$role->is_superadmin)
        <div class="panel panel-default">
            <div class="panel panel-heading">
                <i class="fa fa-unlock"></i> Permissões deste papel
            </div>
            <div class="panel panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Recursos/Módulos</th>
                        <th class="text-center">Acessar</th>
                        <th class="text-center">Criar</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Visualizar</th>
                        <th class="text-center">Excluir</th>
                    </thead>
                    <tbody>
                        @php $count=1 @endphp
                        @foreach($modules as $m)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $m->description }}</td>
                            <td class="text-center">
                                @if(strpos($m->access,'A') === false)
                                <span class="label label-default">n/a</span>
                                @else
                                @if(in_array($m->prefix."_access", $permissions))
                                <span class="label label-success">Sim</span>
                                @else
                                <span class="label label-danger">Não</span>
                                @endif
                                @endif
                            </td>

                            <td class="text-center">
                                @if(strpos($m->access,'C') === false)
                                <span class="label label-default">n/a</span>
                                @else
                                @if(in_array($m->prefix."_create", $permissions))
                                <span class="label label-success">Sim</span>
                                @else
                                <span class="label label-danger">Não</span>
                                @endif
                                @endif
                            </td>

                            <td class="text-center">
                                @if(strpos($m->access,'U') === false)
                                <span class="label label-default">n/a</span>
                                @else
                                @if(in_array($m->prefix."_edit", $permissions))
                                <span class="label label-success">Sim</span>
                                @else
                                <span class="label label-danger">Não</span>
                                @endif
                                @endif
                            </td>

                            <td class="text-center">
                                @if(strpos($m->access,'R') === false)
                                <span class="label label-default">n/a</span>
                                @else
                                @if(in_array($m->prefix."_show", $permissions))
                                <span class="label label-success">Sim</span>
                                @else
                                <span class="label label-danger">Não</span>
                                @endif
                                @endif
                            </td>

                            <td class="text-center">
                                @if(strpos($m->access,'D') === false)
                                <span class="label label-default">n/a</span>
                                @else
                                @if(in_array($m->prefix."_delete", $permissions))
                                <span class="label label-success">Sim</span>
                                @else
                                <span class="label label-danger">Não</span>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @php $count++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <div class="panel-footer">
        <span>
            <a class='' href='{{ route('roles.index') }}'><i class='fa fa-chevron-circle-left'></i> Retorna
                para a tela de consulta</a>
        </span>
    </div>
</div>
@stop
