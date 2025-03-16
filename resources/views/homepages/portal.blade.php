@extends('layouts.portal.portallayout')
{{--
include setting for title
site description, site_keywords,
website name --}}
<style>
    .bg-green-25 {
        background-color: #05274744;
    }
</style>


@section('content')
    <div class="container-fluid img-login-bg vh-100">
        <div class="">
            <div class="row">
                <div class="d-none d-md-flex justify-content-center align-items-center bg-green col-5 text-light ">
                    <img src="{{ asset("assets/icons/cream-no-bg.png") }}" alt="" srcset="">
                </div>
                <div
                    class="d-flex bg-green-25 justify-content-center blur-20 align-items-center col-12 col-md-7 vh-100 text-light ">
                    <div class="text-center rounded-2 p-5">

                        <div class="text-center bg-light d-flex gap-3 text-green rounded-2 p-5">
                            <div><a class="btn btn-primary fs-8" href="{{ route('student') }}">Student Login
                                </a></div>
                            <div><a class="btn btn-secondary fs-8" href="{{ route('teacher') }}">Teachers Login
                                </a></div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>


@endsection
