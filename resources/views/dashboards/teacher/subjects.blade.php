@extends('layouts.dashboard.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')


    <!-- this is the end of the mobile view -->
    <section class="main p-0 col-12 col-md-9 text-center">
        <div class="main-body overflow-auto vh-100">
          <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
            <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button"
              aria-controls="mobileMenu">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
              </svg>
            </div>
            <div class="fs-6 fw-bold text-blue align-self-center "> {{ $title }}</div>
          </div>
          <div class="bg-light text-blue full-height px-3 rounded">
            @if ($currentTermSession && $currentTermSession->session)
                <div class="text-start px-2 py-5">
                    <div class="fs-6 fw-semibold">SESSION: {{ $session->name }}, TERM: {{ $term->name }}</div>
                    <div class="fs-7">Select a course to enter/modify scores for students.</div>
                </div>
            @else
                <div class="alert alert-warning">
                    No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                </div>
            @endif
            <div class="d-grid gap-4">
                @foreach ($assignments as $item)

                    <form method="POST" action="{{ route('teacher.manage_scores') }}">
                        @csrf

                        <input type="hidden" name="class_id" value="{{ $item->class_id }}">
                        <input type="hidden" name="subject_id" value="{{ $item->subject_id }}">
                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <input type="hidden" name="term_id" value="{{ $termId }}">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->class->class_name }}</h5>
                                <p class="card-text">{{ $item->subject->subject_name }} ({{ $item->class->class_name }})</p>
                                <button type="submit" class="btn btn-secondary">
                                    Manage Scores
                                </button>
                            </div>
                        </div>
                    </form>
                @endforeach

            </div>
          </div>
        </div>
      </div>
    </section>



@endsection
