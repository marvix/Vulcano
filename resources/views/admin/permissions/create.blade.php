@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-briefcase'></i> Cadastra uma nova permissão</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('permissions.index') }}">Permissão</a>
    </li>
    <li class="active">Cadastramento</li>
</ol>

@stop
@section('content')

<form action="{{ route('permissions.store') }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-table"></i> Formulário de inserção de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <div class="col-sm-12">

                <!-- name -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="name">Nome da Permissão <span class="text-red">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required value="{{ old('name') }}">
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
                        <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" required value="{{ old('description') }}">
                    </div>
                    @if($errors->has('description'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('description') }}
                    </span>
                    @endif
                </div>
            </div>

        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('permissions.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Gravar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop

@section('js')
<script src="{{ asset('vendor/vulcano/js/permissions.js') }}"></script>
@stop
