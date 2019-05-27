@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class='fa fa-database'></i> Alteração de dados do Usuário</h1>
</span>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('home') }}"><i class='fa fa-dashboard'></i> Dashboard</a>
    </li>
    <li class="active">Profile</li>
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


<form action="{{ route('profile.update', $user->id) }}" method="post" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="panel panel-default">
        <div class="panel-heading">
            Formulário de alteração de dados
        </div> <!-- panel-heading -->

        <div class="panel-body">

            <!-- lado esquerdo -->
            <div class="col-sm-3">
                <!-- avatar -->
                <div class="image text-center">
                    <label for="avatar">Seu Avatar</label>
                    <br />

                    @php $canDeleteAvatar = false; @endphp

                    @if($avatar != "")
                    <img src="{{ asset($avatar) }}" width="140px" alt="avatar" class="img-circle">
                    <input type="hidden" name="avatar_id" value="{{ $avatar_id }}">
                    @php $canDeleteAvatar = true; @endphp

                    @elseif(Gravatar::exists($user->email))
                    <img src="{{ Gravatar::get($user->email) }}" width="100px" alt="avatar" class="img-circle">

                    @else
                    <img src="{{ asset('img/avatar/no-photo.png') }}" width="100px" alt="avatar" class="img-circle">
                    @endif
                    <div class="row">&nbsp;</div>

                    <div class="btn-group-xs center-block" role="group">
                        <div class="btn btn-success  div-avatar">
                            <input type="file" id="avatar" name="avatar" class="input-avatar">
                            <span><i class="fa fa-photo"></i> Novo Avatar</span>
                        </div>
                        @if($canDeleteAvatar)
                        <a href="{{ route('delete.avatar.profile') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Excluir Avatar</a>
                        @endif

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

                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ $user->name }}" required>

                        @if($errors->has('name'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- gender -->
                <div class="form-group">
                    <div class="input-group col-sm-4">
                        <label for="level">Gênero
                            <span class="text-red">*</span>
                        </label>

                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender" require>
                            <option value="N" {{ $user->gender == "N" ? "selected" : "" }}>Prefiro não responder</option>
                            <option value="M" {{ $user->gender == "M" ? "selected" : "" }}>Masculino</option>
                            <option value="F" {{ $user->gender == "F" ? "selected" : "" }}>Feminino</option>
                        </select>

                        @if($errors->has('gender'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('gender') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- email -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="email">E-mail
                            <span class="text-red">*</span>
                        </label>

                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ $user->email }}" required>

                        @if($errors->has('email'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- password -->
                <div class="form-group">
                    <div class="input-group col-sm-7">
                        <label for="password">Senha</label>

                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Deixe em branco para não alterar a senha">

                        @if($errors->has('password'))
                        <span class='invalid-feedback text-red'>
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
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

@stop
