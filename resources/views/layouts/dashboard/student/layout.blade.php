<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--styles -->
   <!--styles -->
   <link rel="stylesheet" href="{{ asset("assets/student/style/styles.css") }}" />
   <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css") }}" />
   <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>
<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <main class="container-fluid">
        <div class="row">

            @include('inc.dashboard.student.sidebar')

            @include('inc.dashboard.student.sidebar-mobile')

            @yield('content')

        </div>
    </main>

    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/student/jquery/jquery.min.js") }}"></script>
    <script>
        $(window).load(function () {
            $(".preloader").delay(400).fadeOut("slow");
            $("#overlayer").delay(400).fadeOut("slow");
        });
    </script>
</body>
</html>
