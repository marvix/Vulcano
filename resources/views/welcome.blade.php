@php
    $img = rand(1,6);
@endphp

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))@yield('title', config('adminlte.title', 'AdminLTE 2'))@yield('title_postfix', config('adminlte.title_postfix', ''))</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600,700" rel="stylesheet" type="text/css">

        <!-- Styles -->
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
    </head>

    <body class="background">
        <!-- menu superior da página -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">
                        <span class="brand">{{ config('adminlte.title') }}</span>
                    </a>
                </div>

                @if (Route::has("login"))
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                    @auth
                        <li><a href="{{ url('/home') }}">Painel de Controle</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Registrar-se</a></li>
                    @endauth
                    </ul>
                </div>
                @endif
            </div>
        </nav>

        <!-- Área central da página -->
        <div class="content">

        </div>

        <!-- Rodapé da página -->
        <div class="row">
            <footer class="main-footer footer">
                <div class="pull-left hidden-xs" style="margin-left:10px;margin-top:15px;">
                    {!! env('FOOTER_LEFT') !!}
                </div>
                <div class="pull-right hidden-xs" style="margin-right:10px;margin-top:15px;">
                    {!! env('FOOTER_RIGHT') !!}
                </div>
            </footer>
        </div>

        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    </body>
</html>
