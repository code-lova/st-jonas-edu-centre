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

        <header>
            <nav class="navbar p-0 fixed-top navbar-expand-lg bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand py-2 fs-6 text-green" href="/">
                        <img src="/assets/icons/green png.png" width="30" alt="" class="img-fluid" />
                        St. Jonas Educational Center</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse fw-semibold justify-content-end navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item p-2 nav-active">
                                <a class="nav-link text-green" aria-current="page" href="{{ url("/") }}">Home</a>
                            </li>
                            <li class="nav-item p-2 dropdown">
                                <a class="nav-link dropdown-toggle text-green" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu rounded-1 fw-semibold">
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="{{ route('history') }}">History</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="/vision-mission/">Vision
                                            and Mission
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="{{ route('management') }}"> Staff and Management</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="{{ route('anthem') }}">School Anthem</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item p-2   dropdown">
                                <a class="nav-link dropdown-toggle text-green" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admission
                                </a>
                                <ul class="dropdown-menu rounded-1 fw-semibold">
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="{{ route('whyus') }}">Why Choose
                                            US</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="/apply/">Apply</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="/faq/">FAQs</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item p-2  dropdown">
                                <a class="nav-link dropdown-toggle text-green" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Academics
                                </a>
                                <ul class="dropdown-menu rounded-1 fw-semibold">
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2 fw-semibold" href="{{ route('portal') }}">School
                                            Portal</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="/Online-learning/">Online-Learning</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-semibold py-2" href="/calendars-programs/">Calendar and Programs</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item p-2 ">
                                <a class="nav-link text-green" href="/contact/">Contact</a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link text-green" href="{{ route('login') }}">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        @include("inc.footer")
    </div>

    <script src="{{ asset("assets/js/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <!-- <script src="/js/bootstrap.js"></script> -->
</body>
</html>
