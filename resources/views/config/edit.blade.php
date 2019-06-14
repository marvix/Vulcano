@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados da configuração</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Configuração</a>
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
            Formulário de alteração de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">
                <!-- key -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Chave
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" id="key" name="key" value="{{ $config->key }}" required>

                        @if($errors->has('key'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('key') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- value -->
                <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label for="name">Valor
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" id="value" name="value" value="{{ $config->value }}" required>

                        @if($errors->has('value'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('value') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- type -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Tipo
                            <span class="text-red">*</span>
                        </label>

                        <select name="type" id="type" class="form-control" required>
                            <option value="integer" {{ $config->key =="integer" ? "selected": ""}}>Inteiro</option>
                            <option value="float" {{ $config->key =="float" ? "selected": ""}}>Real</option>
                            <option value="money" {{ $config->key =="money" ? "selected": ""}}>Monetário</option>
                            <option value="string" {{ $config->key =="string" ? "selected": ""}}>Texto</option>
                            <option value="boolean" {{ $config->key =="boolean" ? "selected": ""}}>Lógico</option>
                            <option value="date" {{ $config->key =="date" ? "selected": ""}}>Data</option>
                            <option value="datetime" {{ $config->key =="datetime" ? "selected": ""}}>Data/Hora</option>
                            <option value="time" {{ $config->key =="time" ? "selected": ""}}>Hora</option>
                        </select>

                        <!-- <input type="text" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" id="type" name="type" value="{{ $config->type }}" required> -->

                        @if($errors->has('type'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('type') }}
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

                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" value="{{ $config->description }}" required>

                        @if($errors->has('description'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('description') }}
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
