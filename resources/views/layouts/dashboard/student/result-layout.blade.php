<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @php
            $settings = App\Models\Settings::find(1);
        @endphp

        <!--styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <style>
            *{
                padding: 0px;
                margin: 0px;
            }
            .bg-school{
                background-color: #063806;
            }
            .result-content{
                border: 2px solid #063806;
            }
            .border-green{
                border: 2px solid #063806;
            }
            .result-sum{
                background-color: #063806;
            }
            .remark{
                border-bottom:2px solid #063806;;
            }
            .text-green{
                color: #063806;
            }
            th{
                background-color: #063806 !important;
                color: #ffffff !important;
                font-weight: lighter;
                padding: .2rem !important;
            }
            td{
                text-transform: capitalize;
            }


        </style>
    </head>


    <body class=" overflow-x-hidden">

        <!-- Button for the printing the result -->
        <button class="col-12 d-md-block d-none bg-school py-2 text-white text-uppercase border-0 rounded-2" onclick="printPage()">print result</button>

        <!-- The container for the logo and school Name -->
        <div class="result-header  d-flex row mt-2 ">
            <!-- school logo -->
            <div class="col-md-3 d-none d-md-flex align-items-center justify-content-center">
                @if($settings)<img src="{{ asset('uploads/'.$settings->site_logo) }}" alt="School logo" srcset="" class="border-3 border-dark">@endif

            </div>
            <!-- school name and address-->
            <div class=" col-12 col-md-6 text text-center">
                <h1 class="text-uppercase fs-2  text-green pt-md-4 pt-2">@if($settings){{ $settings->site_name }}@endif</h1>
                <p>@if($settings){{ $settings->address }}@endif</p>
                <p>@if($settings){{ $settings->mobile }}@endif</p>
                <p>@if($settings){{ $settings->email }}@endif</p>

            </div>
            <div class="col-md-3 d-none  bg-dark-subtle"></div>

        </div>

        @yield('content')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function printPage(){
                window.print();
            }
        </script>
    </body>
</html>
