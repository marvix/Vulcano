@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Inclusão de um novo papel</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('roles.index') }}">Papel</a>
    </li>
    <li class="active">Inclusão</li>
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

<form action="{{ route('roles.store') }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de inclusão de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">
                <!-- name -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Nome do Papel
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required value="{{ old('name') }}">

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

                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ old('description') }}">

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
                            <option value="1">Sim</option>
                            <option value="0" selected>Não</option>
                        </select>

                        @if($errors->has('is_superadmin'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('is_superadmin') }}
                        </span>
                        @endif
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
