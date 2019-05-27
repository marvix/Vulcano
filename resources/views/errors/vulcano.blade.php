@php
$img = rand(1,5);
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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Knewave&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">

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
            background: url("{{ asset('img/errors/error0').$img.'.jpg' }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: #fff;
            position: fixed;
            margin: 0;
            margin-bottom: 0;
            bottom: 0;
        }

        .code {
            border-right: 2px solid;
            font-size: 120px;
            padding: 0 15px 0 15px;
            text-align: center;
            padding-top: 70px;
            color: #80808099;
            font-family: 'Knewave';
        }

        .message {
            font-size: 32px;
            text-align: center;
        }

        .text {
            font-size: 20px;
            text-align: center;
            padding-top: 20px;
            font-family: Merriweather;
        }
    </style>
</head>

<body class="background">
    <div class="content">
        <div class="code">
            <span class="text-bold text-blue">
                @yield('code')
            </span>
        </div>

        <div class="message" style="padding: 10px;">
            @yield('message')
            <br>
            <div class="text">
                @yield('text')
            </div>
            <br><br>
            <a href="{{ route('home') }}" class="btn btn-default btn-flat btn-lg">Voltar ao Sistema</a>
        </div>
    </div>

    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
