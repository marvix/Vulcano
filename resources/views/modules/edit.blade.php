@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-briefcase'></i> Alteração dos dados de um módulo</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('permissions.index') }}">Módulo</a>
    </li>
    <li class="active">Alteração</li>
</ol>

@stop
@section('content')

<form action="{{ route('modules.update', $module->id) }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-table"></i> Formulário de alteração de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">

                <!-- prefix -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Prefixo <span class="text-red">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('prefix') ? 'is-invalid' : '' }}" id="prefix" name="prefix" required value="{{ $module->prefix }}">
                    </div>
                    @if($errors->has('prefix'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('prefix') }}
                    </span>
                    @endif
                </div>

                <!-- description -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">Descrição <span class="text-red">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ $module->description }}">
                    </div>
                    @if($errors->has('description'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('description') }}
                    </span>
                    @endif
                </div>

                <!-- direitos -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">Direitos</label>
                        <br />
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-info btn-flat" style="width:80px;margin-right:6px;">
                                <input type="checkbox" name="access" id="access" autocomplete="off" @if(strpos($module->access,"A") !== false) checked @endif> Acessar
                            </label>
                            <label class="btn btn-success btn-flat" style="width:80px;margin-right:6px;">
                                <input type="checkbox" name="create" id="create" autocomplete="off" @if(strpos($module->access,"C") !== false) checked @endif> Criar
                            </label>
                            <label class="btn btn-primary btn-flat" style="width:80px;margin-right:6px;">
                                <input type="checkbox" name="read" id="read" autocomplete="off" @if(strpos($module->access,"R") !== false) checked @endif> Ler
                            </label>
                            <label class="btn btn-warning btn-flat" style="width:80px;margin-right:6px;">
                                <input type="checkbox" name="edit" id="edit" autocomplete="off" @if(strpos($module->access,"U") !== false) checked @endif> Editar
                            </label>
                            <label class="btn btn-danger btn-flat" style="width:80px;">
                                <input type="checkbox" name="delete" id="delete" autocomplete="off" @if(strpos($module->access,"D") !== false) checked @endif> Excluir
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- panel-body -->

    <div class="panel-footer">
        <a class="btn btn-default" href="{{ route('modules.index') }}">
            <i class="fa fa-chevron-circle-left"></i> Voltar
        </a>

        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Alterar</button>
    </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/permissions.js') }}"></script>
@stop
