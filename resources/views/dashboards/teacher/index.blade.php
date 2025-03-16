@extends('layouts.dashboard.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <section class="main col-12 p-0 col-md-9 text-center">
        <div class="main-body overflow-auto vh-100 text-blue">
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button"
                aria-controls="mobileMenu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
                </div>
                <div class="fs-6 fw-bold text-blue align-self-center ">Dashboard</div>
            </div>
            <div class="bg-light vh-100 px-3 rounded">
                <div class="text-start px-2 py-5">
                <div class="fs-6 d-flex">
                    Welcome Tutor
                    <div class="px-1 fw-semibold">Osasere</div>
                </div>
                <div class="fs-7">
                    Hope you are having a great time
                </div>
                </div>
                <div class="d-flex gap-3">
                <a href="/dashboard/enter-scores/" class="btn btn-secondary btn-sm fs-7">Manage scores</a>
                <a href="/dashboard/my-profile/" class="btn btn-sm btn-secondary fs-7">View my profile</a>
                </div>
            </div>
        </div>
    </section>



@endsection
