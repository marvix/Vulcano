@php
use App\Helpers\Helper;
$background = Helper::selectBackgroundImage('/img/background/', 'back', '/back[0-9]+.jpg/');
@endphp

@extends('adminlte::master')

@section('adminlte_css')
<style>
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body,
        html {
            width: 100%;
            height: 100%;
        }

    .background {
        background: url("{{ $background }}");
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
        background-color: rgba(0, 0, 0, 0.5);
        border-top: solid 1px #424242;
        color: #ACACAC;
        left: 0px;
        right: 0px;
        bottom: 0px;
        margin-left: auto;
        margin-right: auto;
        position: fixed;
        height: 50px;
        font-family: Roboto, sans-serif;
        font-size: 15px;
        font-weight: 500;
    }

    .brand {
        font-family: Raleway, sans-serif;
        font-weight: 600;
    }
</style>

<link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
@yield('css')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">

@stop

@section('body_class', 'login-page background')

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

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>

        @if(env('ENABLE_SOCIALITE'))
        @include('vendor/adminlte/socialite')
        @endif

        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ trans('adminlte::adminlte.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div class="auth-links text-center">
            <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
            |
            @if (config('adminlte.register_url', 'register'))
            <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="text-center">{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
            @endif
        </div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

@include('vendor/adminlte/footer')

@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

@if(config('adminlte.plugins.sweetalert2'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@include('sweet::alert')
@endif

@yield('js')
@stop
