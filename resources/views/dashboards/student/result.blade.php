@extends('layouts.dashboard.student.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')


    <section class="main p-0 col-12 col-md-9 text-center">
        <div class="main-body text-green overflow-auto vh-100">
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button" aria-controls="mobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <div class="fs-6 fw-bold text-green align-self-center ">{{ $title }}</div>
            </div>

            <!-- if there is any available result to view show the below card -->

            <div class="bg-light full-height px-3 rounded">
                @if ($settings && $settings->open_result == 0)
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold" style="color: rgb(189, 10, 10)">Result is unavailable at the moment</div>
                    </div>
                @else
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold ">Avalaible Results</div>
                    </div>
                @endif

                @if(!$currentTermSession || !$currentTermSession->session)
                    <div class="alert alert-warning">
                        No active term and session set by the admin Yet.
                    </div>
                @else
                    <div class="d-grid gap-4">
                        <form action="{{ route('view.result') }}" method="POST" target="_blank">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $classId }}" required>
                            <input type="hidden" name="student_id" value="{{ $studentId->id }}" required>
                            <input type="hidden" name="session_id" value="{{ $currentTermSession->session->id }}" required>
                            <input type="hidden" name="term_id" value="{{ $currentTermSession->id }}" required>

                            <div class="bg-green-lighter text-light rounded-1 p-3 text-uppercase text-start">
                                <div class="fs-6 fw-semibold">Class:<span class="px-2">{{ $studentId->currentClassApplying->class_name }}</span></div>
                                <div class="fs-7">Session: <span class="px-1">{{ $currentTermSession->session->name }}</span></div>
                                <div class="fs-7">Term: <span class="px-1">{{ $currentTermSession->name }}</span></div>
                                @if ($settings && $settings->open_result == 0)
                                <div class="d-grid">
                                    <p></p>
                                </div>
                                @else
                                    <div class="d-grid">
                                        <button class="btn btn-primary">View Result</button>
                                    </div>
                                @endif

                            </div>
                        </form>

                    </div>
                @endif

            </div>
        </div>
    </section>


@endsection
