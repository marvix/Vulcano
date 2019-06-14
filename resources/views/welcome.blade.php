@php
use App\Helpers\Helper;
$background = Helper::selectBackgroundImage('/img/background/', 'back', '/back[0-9]+.jpg/');
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">

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
            position: fixed;
            margin: 0;
            margin-bottom: 0;
            bottom: 0;
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
        }

        .brand {
            font-family: Raleway, sans-serif;
            font-weight: 600;
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
                    <span class="brand">
                        @if (\Session::get('brand'))
                        {!! \Session::get('brand') !!}
                        @else
                        {!! config('adminlte.title') !!}
                        @endif
                    </span>
                </a>
            </div>

            @if (Route::has("login"))
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @auth
                    <li><a href="{{ url('/home') }}">Painel de Controle</a></li>
                    @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @if(Route::has("register"))
                    <li><a href="{{ route('register') }}">Registrar-se</a></li>
                    @endif
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
            <div class="pull-left hidden-xs" style="margin-left:20px;margin-top:13px;">
                @if(\Session::get('footer_left'))
                {!! \Session::get('footer_left') !!}
                @else
                {!! env('FOOTER_LEFT') !!}
                @endif
            </div>
            <div class="pull-right hidden-xs" style="margin-right:20px;margin-top:13px;">
                @if(\Session::get('footer_right'))
                {!! \Session::get('footer_right') !!}
                @else
                {!! env('FOOTER_RIGHT') !!}
                @endif
            </div>
        </footer>
    </div>

    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>

</html>
