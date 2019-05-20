@php
    $img = rand(1,6);
@endphp

@extends('adminlte::master')

@section('adminlte_css')

    <style>
        .background {
            background: url("{{ asset('img/background/back0').$img.'.png' }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: #fff;
            margin: 0;
            margin-bottom: 0;
            bottom: 0;
            height: 600px;
        }

        .footer {
            background-color: rgba(0,0,0,0.5);
            border-top: solid 1px #424242;
            color: #ACACAC;
            left: 0px;
            right: 0px;
            bottom:0px;
            margin-left: auto;
            margin-right: auto;
            position: fixed;
            height: 50px;
        }
        .brand {
            font-family: Raleway, sans-serif;
            font-weight: 700;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600,700" rel="stylesheet" type="text/css">

@stop

@section('body_class', 'register-page background')

@section('body')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ url('/') }}" class="navbar-brand">
                    <span class="brand">{{ config('adminlte.title') }}</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="register-box">
        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
            </form>
            <div class="auth-links text-center">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- Rodapé da página -->
    <div class="row">
        <footer class="main-footer footer">
            <div class="pull-left hidden-xs" style="margin-left:10px">
                {!! env('FOOTER_LEFT') !!}
            </div>
            <div class="pull-right hidden-xs" style="margin-right:10px">
                {!! env('FOOTER_RIGHT') !!}
            </div>
        </footer>
    </div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
