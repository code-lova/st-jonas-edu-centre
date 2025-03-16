@extends('layouts.otherpage')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <div class="py-3 bg-green">
        <div class="container text-light">
            <div class="fs-4">Vision and Mission</div>
            <hr />
            <div class="fs-7">
                You can contact us regarding any inquiry or issue and our
                Support Team
                will get right on it
            </div>
        </div>
    </div>
    <main class="bg-light">
        <div class="container py-5 bg-white">
            <div class="row py-5">
                <div class="col-12 col-md-8">
                </div>
                <div class="col-4 d-none d-md-block">
                    <div class="container-fluid">
                        <div class="row bg-green">
                            <div class="d-grid p-0">
                                <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                    href="/history/">
                                    <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                        </svg>History</div>
                                </a>
                            </div>
                            <div class="d-grid p-0">
                                <a class="link-underline small-menu-active small-menu p-2 text-light link-underline-opacity-0"
                                    href="/vision-mission/">

                                    <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                        </svg>Vision and
                                        Mission </div>
                                </a>
                            </div>
                            <div class="d-grid p-0">
                                <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                    href="/Staff-Management/">
                                    <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                        </svg>Staff and Management
                                        </div>
                                </a>
                            </div>
                            <div class="d-grid p-0">
                                <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                    href="/school-anthem/">
                                    <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                        </svg> School Anthem</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
