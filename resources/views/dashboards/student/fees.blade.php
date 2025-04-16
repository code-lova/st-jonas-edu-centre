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
                <div class="fs-6 fw-bold text-green align-self-center ">{{ $title }}</div>
            </div>
            <div class="bg-light full-height px-3 rounded">
                <div class="info">
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold text-capitalize">Your Fees Payment Info</div>
                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection
