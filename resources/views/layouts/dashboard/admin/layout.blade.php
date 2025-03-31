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
   <link rel="stylesheet" href="{{ asset("assets/teacher/style/styles.css") }}" />
   <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css") }}" />
   <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

     <!-- Laravel Toastr Alert Css -->
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .btn-secondary {
            --bs-btn-bg: #650018;
            --bs-btn-border-color: #650018;
            --bs-btn-disabled-bg: #650018;
            --bs-btn-disabled-border-color: #650018;

            &:hover {
                color: #650018;
                border: 1px solid #650018;
            }
        }

        .text-red {
            color: #650018;
        }

        .loader {
            border-top: 16px solid #650018;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <main class="container-fluid">
        <div class="row">

            @include('inc.dashboard.admin.sidebar')

            @include('inc.dashboard.admin.sidebar-mobile')

            @yield('content')

        </div>
    </main>

    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/teacher/jquery/jquery.min.js") }}"></script>
    <script>
        $(window).load(function () {
            $(".preloader").delay(400).fadeOut("slow");
            $("#overlayer").delay(400).fadeOut("slow");
        });
    </script>
    <!-- Toastr alert Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif

        //This secipt is for filtering or sorting tables
        $(window).load(function () {
            $(".preloader").delay(400).fadeOut("slow");
            $("#overlayer").delay(400).fadeOut("slow");
        });
        function myFunction() {
            // Declare variables
            let input, filter, table, tr, td, tdl, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                tdl = tr[i].getElementsByTagName("td")[1];
                tdsubject = tr[i].getElementsByTagName("td")[2];
                tdclasses = tr[i].getElementsByTagName("td")[3];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    tdlValue = tdl.textContent || tdl.innerText;
                    tdsubjectValue = tdsubject.textContent || tdsubject.innerText;
                    tdclassesValue = tdclasses.textContent || tdclasses.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else if (tdlValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                    else if (tdclassesValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                    else if (tdsubjectValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                    else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


</body>
</html>
