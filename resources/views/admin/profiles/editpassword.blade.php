@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de senha</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Usuários</a>
    </li>
    <li class="active">Alteração de senha</li>
</ol>

@stop
@section('content')

<form action="{{ route('profile.password.save', $user->id) }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de alteração de senha
        </div> <!-- panel-heading -->

        <div class="panel-body">
            <!-- password -->
            <div class="col-sm-9">
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="password">Nova Senha <span class="text-red">*</span></label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" required>
                    </div>
                    @if($errors->has('password'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- password -->
            <div class="col-sm-9">
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="password">Redigite a Nova Senha <span class="text-red">*</span></label>
                        <input type="password" class="form-control {{ $errors->has('retypePassword') ? 'is-invalid' : '' }}" id="retypePassword" name="retypePassword" required>
                    </div>
                    @if($errors->has('retypePassword'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('retypePassword') }}
                    </span>
                    @endif
                </div>
            </div>
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('home') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Alterar a Senha</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop
