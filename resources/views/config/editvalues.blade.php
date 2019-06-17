@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Configuração do Sistema</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Configuração do Sistema</li>
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


<form action="{{ route('config.savevalues') }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- <input type="hidden" name="_method" value="PUT"> -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-table"></i> Definição dos parâmetros de configuração do Sistema
        </div> <!-- panel-heading -->

        <div class="panel-body">
            @foreach($config as $c)

            @if($c->type == "text")
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="{{ $c->slug_key }}">{{ $c->description }}
                            <span class="text-red">*</span>
                        </label>

                        <input type="text" class="form-control {{ $errors->has('$c->slug_key') ? 'is-invalid' : '' }}" id="{{ $c->slug_key }}" name="{{ $c->slug_key }}" value="{{ $c->value }}" required>
                    </div>
                    @if($errors->has('$c->slug_key'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('$c->slug_key') }}
                    </span>
                    @endif
                </div>

            </div>
            @endif

            @if($c->type == "integer")
            @php
            if($c->dataenum) {
            $range = explode(',', $c->dataenum);
            }
            @endphp
            <div class="row">

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="{{ $c->slug_key }}">{{ $c->description }}
                            <span class="text-red">*</span>
                        </label>

                        <input type="number" class="form-control {{ $errors->has('$c->slug_key') ? 'is-invalid' : '' }}" id="{{ $c->slug_key }}" name="{{ $c->slug_key }}" value="{{ $c->value }}" required @if(isset($range[0])) min="{{$range[0]}}" @endif @if(isset($range[1])) max="{{$range[1]}}" @endif>
                    </div>
                    @if($errors->has('$c->slug_key'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('$c->slug_key') }}
                    </span>
                    @endif
                </div>
            </div>

            @endif
            @endforeach
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('home') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Atualizar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop
