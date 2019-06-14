@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-briefcase'></i> Edição de um papel</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('roles.index') }}">Papel</a>
    </li>
    <li class="active">Edição</li>
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

<form action="{{ route('roles.update', $role->id) }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-table"></i> Formulário de edição de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">
                <!-- name -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Nome do Papel
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required value="{{ $role->name }}">

                        @if($errors->has('name'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- description -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">Descrição
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ $role->description }}">

                        @if($errors->has('description'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- is_superadmin -->
                <div class="form-group">
                    <div class="input-group col-sm-2">
                        <label for="name">É Super Administrador?
                            <span class="text-red">*</span>
                        </label>

                        <select id="is_superadmin" name="is_superadmin" class="form-control {{ $errors->has('is_superadmin') ? 'is-invalid' : '' }}" required onchange="changeSuperAdmin();">
                            <option value="1" @if($role->is_superadmin) selected @endif>Sim</option>
                            <option value="0" @if(!$role->is_superadmin) selected @endif>Não</option>
                        </select>

                        @if($errors->has('is_superadmin'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('is_superadmin') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="line"></div>
            <div class="col-sm-12" id="roles-permissions" style="display:none">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        <i class="fa fa-unlock"></i> Permissões deste papel
                    </div>

                    <div class="panel panel-body">
                        <div class="table table-responsive">
                            <table class="table table-bordered table-responsive">
                                <thead class="text-bold">
                                    <td class="col-sm-1">#</td>
                                    <td class="col-sm-6">Recursos / Módulos</td>
                                    <td class="col-sm-1 text-center">Todos</td>
                                    <td class="col-sm-1 text-center">Acessar</td>
                                    <td class="col-sm-1 text-center">Criar</td>
                                    <td class="col-sm-1 text-center">Editar</td>
                                    <td class="col-sm-1 text-center">Visualizar</td>
                                    <td class="col-sm-1 text-center">Excluir</td>
                                </thead>
                                <tbody>
                                    @php $count=0 @endphp
                                    @foreach($modules as $m)
                                    <tr>
                                        <input type="hidden" name="module[]" value="{{ $m->prefix }}">
                                        <td>{{ $count+1 }}</td>
                                        <td>{{ $m->description }}</td>

                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="todos[]" onclick="markAll({{ $count }})">
                                        </td>

                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="acessar[]" value="{{ $m->prefix }}_access" @if(in_array($m->prefix."_access", $permissions)) checked @else "" @endif>
                                        </td>

                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="criar[]" value="{{ $m->prefix }}_create" @if(in_array($m->prefix."_create", $permissions)) checked @else "" @endif>
                                        </td>

                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="editar[]" value="{{ $m->prefix }}_edit" @if(in_array($m->prefix."_edit", $permissions)) checked @else "" @endif>
                                        </td>

                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="visualizar[]" value="{{ $m->prefix }}_show" @if(in_array($m->prefix."_show", $permissions)) checked @else "" @endif>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="excluir[]" value="{{ $m->prefix }}_delete" @if(in_array($m->prefix."_delete", $permissions)) checked @else "" @endif>
                                        </td>
                                    </tr>
                                    @php $count++ @endphp
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('roles.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Gravar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop

@section('js')
<script src="{{ asset('vendor/vulcan/js/roles.js') }}"></script>
@stop
