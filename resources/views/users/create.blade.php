@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Inclusão de novo Usuário</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Usuários</a>
    </li>
    <li class="active">Inclusão de dados</li>
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


<form action="{{ route('users.store') }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de inclusão de usuário
        </div> <!-- panel-heading -->

        <div class="panel-body">

            <!-- lado esquerdo -->
            <div class="col-sm-3">
                <!-- avatar -->
                <div class="image text-center">
                    <label for="avatar">Avatar</label>
                    <br />

                    <img src="{{ asset('img/avatar/no-photo.png') }}" width="140px" alt="avatar" class="img-circle">
                    <input type="hidden" name="avatar_id" }}>
                    <div class="row">&nbsp;</div>

                    <div class="btn-group-xs center-block" role="group">
                        <div class="btn btn-success  div-avatar">
                            <input type="file" id="avatar" name="avatar" class="input-avatar">
                            <span><i class="fa fa-photo"></i> Novo Avatar</span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- lado direito -->
            <div class="col-sm-9">
                <!-- nome do usuário -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="name">Nome do Usuário
                            <span class="text-red">*</span>
                        </label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required value="{{ old('name') }}">
                        </div>
                        @if($errors->has('name'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- gender -->
                <div class="form-group">
                    <div class="input-group col-sm-5">
                        <label for="gender">Gênero
                            <span class="text-red">*</span>
                        </label>

                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender" required>
                            <option value="N">Prefiro não responder</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    @if($errors->has('gender'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('gender') }}
                    </span>
                    @endif
                </div>

                <!-- roles -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="level">Papel atribuído
                            <span class="text-red">*</span>
                        </label>

                        <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" id="roles" name="role" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->description }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('role'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('role') }}
                    </span>
                    @endif
                </div>

                <!-- active -->
                <div class="form-group">
                    <div class="input-group col-sm-3">
                        <label for="level">Deixar o usuário ativo?
                            <span class="text-red">*</span>
                        </label>

                        <select class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}" id="active" name="active" required>
                            <option value="1">Sim</option>
                            <option value="0" selected>Não</option>
                        </select>
                    </div>
                    @if($errors->has('active'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('active') }}
                    </span>
                    @endif
                </div>

                <!-- email -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="email">E-mail
                            <span class="text-red">*</span>
                        </label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" required value="{{ old('email') }}">
                        </div>
                        @if($errors->has('email'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>

                @include('partials.skin')

                <!-- password -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="password">Senha
                            <span class="text-red">*</span>
                        </label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" value="{{ old('password') }}" placeholder="A senha deve ter pelo menos 6 caracteres">
                        </div>
                    </div>
                    @if($errors->has('password'))
                    <span class='invalid-feedback text-red'>
                        {{ $errors->first('password') }}
                    </span>
                    @endif
                </div>
            </div>
        </div> <!-- panel-body -->

        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('users.index') }}">
                <i class="fa fa-chevron-circle-left"></i> Voltar
            </a>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Gravar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel-default -->
</form>
@stop

@section('css')
<style>
    .div-avatar {
        position: relative;
        overflow: hidden;
    }

    .input-avatar {
        position: absolute;
        font-size: 20px;
        opacity: 0;
        right: 0;
        top: 0;
    }
</style>

<!-- @stops -->
