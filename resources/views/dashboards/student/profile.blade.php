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
                        <div class="fs-6 fw-semibold text-capitalize">
                        Your Personal Info
                        </div>
                        <div class="fs-7">
                        To make changes to personal info please contact school
                        Admin.
                        </div>
                    </div>
                    <div class="d-grid gap-4">
                        <ul class="list-group fs-7 list-group-flush text-start">
                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="pe-2">Name:</span>
                            </div>
                            <div class="col-8 col-md-10">
                                <span class="text-capitalize " id="FullName">{{ $studentDetails->firstname }} {{ $studentDetails->middlename ?? '' }}
                                    {{ $studentDetails->lastname }}</span>
                            </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="">Gender:</span>
                            </div>
                            <div class="col-8 col-md-10">
                                <span id="Gender" class="text-lowercase">{{ $studentDetails->sex }}</span>
                            </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="">Father Name:</span>
                            </div>
                                <div class="col-8 col-md-10">
                                    <span class="text-capitalize" id="FatherName">
                                        {{ $studentDetails->parentInfo->parent_name }}
                                    </span>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="">Email:</span>
                            </div>
                            <div class="col-8 col-md-10">
                                <a href="mailto:edenosas1@gmail.com" class="text-green text-lowercase"
                                id="Email"><span>{{ $studentDetails->email ?? 'N/A' }}</span></a>
                            </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="">fathers Phone:</span>
                            </div>
                            <div class="col-8 col-md-10">
                                <a href="tel:+2348165179215" class="text-lowercase text-green" id="Phone">
                                    {{ $studentDetails->parentInfo->fathers_phone }}
                                </a>
                            </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row text-green">
                                <div class="col-4 col-md-2">
                                    <span class="">Mothers Phone:</span>
                                </div>
                                <div class="col-8 col-md-10">
                                    <a href="tel:+2348165179215" class="text-lowercase text-green" id="Phone">
                                        {{ $studentDetails->parentInfo->mothers_phone }}
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row text-green">
                            <div class="col-4 col-md-2">
                                <span class="">Address:</span>
                            </div>
                            <div class="col-8 col-md-10">
                                <span id="Address" class="text-capitalize">
                                    {{ $studentDetails->parentInfo->parent_address }}
                                </span>
                            </div>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
