<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--styles -->
    <link rel="stylesheet" href="{{ asset("assets/teacher/style/styles.css") }}" />
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

                /* General form input styling */
        .form-style {
            width: 100%;  /* Full width for responsiveness */
            padding: 10px;  /* Adjust padding to suit your design */
            border-radius: 5px;  /* Rounded corners */
            border: 1px solid #ccc;  /* Light border color */
            font-size: 14px;  /* Readable font size */
            transition: all 0.3s ease;  /* Smooth transition for focus and hover states */
        }

        /* Focus state */
        .form-style:focus {
            border-color: #007bff;  /* Blue border on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);  /* Soft blue glow */
            outline: none;  /* Remove the default outline */
        }

        /* Placeholder styling */
        .form-style::placeholder {
            color: #6c757d;  /* Placeholder color */
            opacity: 1;  /* Ensure placeholder is fully visible */
        }

        /* Error state */
        .is-invalid {
            border-color: #dc3545;  /* Red border for invalid input */
            background-color: #f8d7da;  /* Light red background for error */
        }

        .is-invalid::placeholder {
            color: #dc3545;  /* Placeholder color for error state */
        }

        .is-invalid:focus {
            border-color: #dc3545;  /* Red border on focus for invalid */
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);  /* Soft red glow */
        }

    </style>
</head>
<body class="bg-blue d-flex full-height align-items-center">
    <div class="preloader">
        <div class="loader"></div>
    </div>

    @yield('content')


    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/teacher/jquery/jquery.min.js") }}"></script>
    <script>
        $(window).load(function () {
            $(".preloader").delay(400).fadeOut("slow");
            $("#overlayer").delay(400).fadeOut("slow");
        });
    </script>
</body>
</html>
