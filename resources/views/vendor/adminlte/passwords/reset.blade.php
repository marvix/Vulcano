@php
use App\Helpers\Helper;
$background = Helper::selectBackgroundImage('/img/background/', 'back', '/back[0-9]+.jpg/');
@endphp

@extends('adminlte::master')

@section('adminlte_css')
<style>
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

<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
@yield('css')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600,700" rel="stylesheet" type="text/css">

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
                <span class="brand">
                    @if( \Session::has('brand') )
                        {!! \Session::get('brand') !!}
                    @else
                        Vulcano
                    @endif
                </span>
            </a>
        </div>
    </div>
</nav>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('adminlte::adminlte.password_reset_message') }}</p>
        <form action="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" method="post">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" class="form-control" value="{{ isset($email) ? $email : old('email') }}" placeholder="{{ trans('adminlte::adminlte.email') }}">
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

            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">
                {{ trans('adminlte::adminlte.reset_password') }}
            </button>
        </form>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

@include('vendor/adminlte/footer')

@stop

@section('adminlte_js')
@yield('js')
@stop
