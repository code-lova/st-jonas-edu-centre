<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--styles -->
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" />
    <link rel="shortcut icon" href="{{ asset("assets/icons/logo.png") }}" type="image/x-icon" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>
    <div>

        <main>
            @yield('content')
        </main>

    </div>
    <script src="{{ asset("assets/js/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <!-- <script src="/js/bootstrap.js"></script> -->

</body>
</html>
