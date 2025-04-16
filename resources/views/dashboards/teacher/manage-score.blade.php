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
            <div class="fs-6 fw-bold text-blue align-self-center ">{{ $title }}</div>
          </div>
            @if ($currentTermSession && $currentTermSession->session)
                <div class="bg-light text-start px-3 py-2">
                    <div class="fs-6 fw-semibold">CURRENT - SESSION: {{ $currentTermSession->session->name }}, CURRENT - TERM: {{ $currentTermSession->name }}</div>
                    <div class="fs-7">Enter/Modify Score for Students in the class you teach this current session/term</div>
                </div>
            @else
                <div class="alert alert-warning">
                    No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                </div>
            @endif
          <div class="bg-light text-blue full-height px-3 rounded">
            <div class="text-start px-2 py-5">
              <div class="fs-6 fw-semibold">Select Session and Term</div>
              <div class="fs-7">Choose the session and term to enter/modify scores for students.</div>
            </div>
            <form id="select-session-term-form"  action="{{ route('teacher.handle.session_term') }}" method="POST">
                @csrf
              <div class="form-group">
                <label for="session_id" class="form-label">Session</label>
                <select name="session_id" id="session" class="form-control w-100 ">
                    <option value="">Select a session</option>
                    @foreach($sessions as $session)
                        <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group mt-3">
                <label for="term_id" class="form-label">Term</label>
                <select name="term_id" id="term" class="form-control w-100">
                    <option value="">Select a term</option>
                    @foreach($terms as $term)
                        <option value="{{ $term->id }}" {{ old('term_id') == $term->id ? 'selected' : '' }}>{{ $term->name }}</option>
                    @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-secondary mt-3">Proceed</button>
            </form>
          </div>
        </div>
    </section>


@endsection
