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
                        <label for="name">Nome do Papel <span class="text-red">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required value="{{ $role->name }}">
                    </div>
                    @if($errors->has('name'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('name') }}
                    </span>
                    @endif
                </div>

                <!-- description -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">Descrição <span class="text-red">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ $role->description }}">
                    </div>
                    @if($errors->has('description'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('description') }}
                    </span>
                    @endif
                </div>

                <!-- is_superadmin -->
                <div class="form-group">
                    <div class="input-group col-sm-2">
                        <label for="name">É Super Administrador? <span class="text-red">*</span></label>
                        <br>
                        <input type="checkbox" class="form-group form-check-input" id="is_superadmin" name="is_superadmin" value="{{ $role->is_superadmin }}" @if($role->is_superadmin) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" onchange="changeSuperAdmin();">
                    </div>
                </div>
            </div>

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

                                        <!-- access -->
                                        @if(strpos($m->access,'A')===false)
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="acessar[]" value="{{ $m->prefix }}_access" readonly disabled data-toggle="toggle" data-on="Sim" data-off="Não" data-offstyle="default" data-size="small">
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="acessar[]" value="{{ $m->prefix }}_access" @if(in_array($m->prefix."_access", $permissions)) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" data-size="small">
                                        </td>
                                        @endif

                                        <!-- create -->
                                        @if(strpos($m->access,'C')===false)
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="criar[]" value="{{ $m->prefix }}_create" readonly disabled data-toggle="toggle" data-on="Sim" data-off="Não" data-offstyle="default" data-size="small">
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group form-check-input" name="criar[]" value="{{ $m->prefix }}_create" @if(in_array($m->prefix."_create", $permissions)) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" data-size="small">
                                        </td>
                                        @endif

                                        <!-- update -->
                                        @if(strpos($m->access,'U')===false)
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="editar[]" value="{{ $m->prefix }}_edit" readonly disabled data-toggle="toggle" data-on="Sim" data-off="Não" data-offstyle="default" data-size="small">
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="editar[]" value="{{ $m->prefix }}_edit" @if(in_array($m->prefix."_edit", $permissions)) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" data-size="small">
                                        </td>
                                        @endif

                                        <!-- read -->
                                        @if(strpos($m->access,'R')===false)
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="visualizar[]" value="{{ $m->prefix }}_show" readonly disabled data-toggle="toggle" data-on="Sim" data-off="Não" data-offstyle="default" data-size="small">
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="visualizar[]" value="{{ $m->prefix }}_show" @if(in_array($m->prefix."_show", $permissions)) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" data-size="small">
                                        </td>
                                        </td>
                                        @endif

                                        <!-- delete -->
                                        @if(strpos($m->access,'D')===false)
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="excluir[]" value="{{ $m->prefix }}_delete" readonly disabled data-toggle="toggle" data-on="Sim" data-off="Não" data-offstyle="default" data-size="small">
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <input type="checkbox" class="form-group" name="excluir[]" value="{{ $m->prefix }}_delete" @if(in_array($m->prefix."_delete", $permissions)) checked @endif data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" data-size="small">
                                        </td>
                                        @endif
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
<script src="{{ asset('vendor/vulcano/js/roles.js') }}"></script>
@stop
