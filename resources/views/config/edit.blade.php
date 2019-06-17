@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados de um parâmetro</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('config.index') }}">Parâmetros do Sistema</a>
    </li>
    <li class="active">Alteração de dados</li>
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

<form action="{{ route('config.update', $config->id) }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de alteração de parâmetros
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">

                <!-- order -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Ordem
                            <span class="text-red">*</span>
                        </label>

                        <input type="number" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" id="order" name="order" required value="{{ old('order', $config->order) }}" min="1" max="9999">

                        @if($errors->has('order'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('order') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- key -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Chave
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" id="key" name="key" required value="{{ old('key', $config->key) }}">

                        @if($errors->has('key'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('key') }}
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

                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ old('description', $config->description) }}">

                        @if($errors->has('description'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- type -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Tipo de Campo
                            <span class="text-red">*</span>
                        </label>

                        <select name="type" id="type" class="form-control" required>
                            <option value="text" @if($config->type=="text") selected @endif>Texto</option>
                            <option value="integer" @if($config->type=="integer") selected @endif>Inteiro</option>
                        </select>
                    </div>
                </div>

                <!-- dataenum -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">
                            DataEnum
                            <small class="text-red"> (formato: param1,param2,param3...)

                        </label>

                        <input type="text" class="form-control {{ $errors->has('dataenum') ? 'is-invalid' : '' }}" id="dataenum" name="dataenum" value="{{ old('dataenum', $config->dataenum) }}">

                        @if($errors->has('dataenum'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('dataenum') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('config.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Atualizar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/roles.js') }}"></script>
@stop
