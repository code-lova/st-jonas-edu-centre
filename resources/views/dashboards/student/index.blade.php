@extends('layouts.dashboard.student.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')


    <section class="main p-0 col-12 col-md-9 text-center">
        <div class="main-body text-green overflow-auto vh-100">
        <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
            <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button"
            aria-controls="mobileMenu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
            </div>
            <div class="fs-6 fw-bold text-green align-self-center ">Dashboard</div>
        </div>
        <div class="bg-light full-height px-3 rounded">
            <div class="text-start px-2 py-5">
            <div class="fs-7 d-flex">
                Welcome
                <span class="px-1 fw-semibold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
            </div>
            <div class="fs-7">
                Hope you are having a great time
            </div>
            </div>
            <div class="d-flex gap-4">
            <a href="{{ route('result') }}" class="btn btn-primary fs-7 btn-sm">View My Result</a>
            <a href="/dashboard-student/my-profile/" class="btn fs-7 btn-sm btn-primary">Holiday Assignment</a>
            </div>
        </div>
        </div>
    </section>

@endsection
