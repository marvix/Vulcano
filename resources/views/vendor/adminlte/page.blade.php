@extends('adminlte::master')

@section('adminlte_css')

@php
if(\Session::has('skin')) {
$skin = \Session::get('skin');
}
else {
$skin = "blue";
}
@endphp

<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . $skin . '.min.css')}} ">
@stack('css')
@yield('css')
@stop

@section('body_class', 'skin-' . $skin . ' sidebar-mini ' . (config('adminlte.layout') ? [
'boxed' => 'layout-boxed',
'fixed' => 'fixed',
'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        @if(config('adminlte.layout') == 'top-nav')
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                        @if(\Session::has('brand'))
                        {!! \Session::get('brand') !!}
                        @else
                        Vulcano
                        @endif
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                @else
                <!-- Logo -->
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        @if(\Session::has('short_brand'))
                        {!! \Session::get('short_brand') !!}
                        @else
                        Vul
                        @endif
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        @if(\Session::has('brand'))
                        {!! \Session::get('brand') !!}
                        @else
                        Vulcano
                        @endif
                    </span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
                    @endif
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    @if(auth()->user()->hasMedia('avatars'))
                                    <img src="{{ asset(Auth::user()->getFirstMediaUrl('avatars')) }}" alt="avatar" class="img-circle" style="width:24px;">
                                    @elseif(Gravatar::exists(Auth::user()->email))
                                    <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="avatar" class="img-circle" style="width:24px;">
                                    @else
                                    <img src="{{ asset('img/avatar/no-photo.png') }}" alt="avatar" class="img-circle" style="width:24px;">
                                    @endif

                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        @if(auth()->user()->hasMedia('avatars'))
                                        <img src="{{ asset(Auth::user()->getFirstMediaUrl('avatars')) }}" alt="avatar" class="img-circle">
                                        @elseif(Gravatar::exists(Auth::user()->email))
                                        <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="avatar" class="img-circle">
                                        @else
                                        <img src="{{ asset('img/avatar/no-photo.png') }}" alt="avatar" class="img-circle">
                                        @endif
                                        <p>
                                            @php
                                            $user = explode(" ", Auth::user()->name);
                                            @endphp
                                            {{ $user[0] }} - {{ Auth::user()->roles[0]->description }}
                                            <small>Membro desde: {{ Auth::user()->created_at->format("d/m/Y") }}</small>
                                            <small>Hoje: {{ ucfirst(Date::now()->format('l, d/m/Y')) }}</small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat" title="Perfil" alt="Perfil">
                                                <i class="fa fa-user"></i> Perfil
                                            </a>

                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('profile.password.edit') }}" class="btn btn-default btn-flat" title="Alterar Senha" alt="Alterar Senha">
                                                <i class="fa fa-key"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Sair do Sistema">
                                                <i class="fa fa-fw fa-power-off"></i>
                                            </a>
                                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                @if(config('adminlte.logout_method'))
                                                {{ method_field(config('adminlte.logout_method')) }}
                                                @endif
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @if(config('adminlte.layout') == 'top-nav')
            </div>
            @endif
        </nav>
    </header>

    @if(config('adminlte.layout') != 'top-nav')

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- exibe o nome e o avatar do usuário na parte superior do menu lateral -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(auth()->user()->hasMedia('avatars'))
                <img src="{{ asset(Auth::user()->getFirstMediaUrl('avatars')) }}" alt="avatar" class="img-circle">
                @elseif(Gravatar::exists(Auth::user()->email))
                <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="avatar" class="img-circle">
                @else
                <img src="{{ asset('img/avatar/no-photo.png') }}" alt="avatar" class="img-circle">
                @endif
            </div>

            <div class="pull-left info">
                <p>{{ str_limit(Auth::user()->name,22) }}</p>
                <a href="#">
                    <i class="fa fa-circle text-lime"></i> Online
                </a>
            </div>
        </div>

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(config('adminlte.layout') == 'top-nav')
        <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
        </div>
        <!-- /.container -->
        @endif
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
@stop
