<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--styles -->
    <link rel="stylesheet" href="{{ asset("assets/student/style/styles.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" />


    <link rel="shortcut icon" href="{{ asset("assets/icons/logo.png") }}" type="image/x-icon" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .form-control {
            color: #ffffff;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .form-control:focus {
            color: #ffffff;
            background-color: #ffffff;
            border-color: #ffffff57;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.507);
        }

        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body class="bg-green full-height d-flex align-items-center">
    <div class="preloader">
        <div class="loader"></div>
    </div>

    @yield('content')

    <script src="{{ asset("assets/student/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script>
        $(window).load(function () {
            $(".preloader").delay(400).fadeOut("slow");
            $("#overlayer").delay(400).fadeOut("slow");
        });
    </script>
</body>
</html>
