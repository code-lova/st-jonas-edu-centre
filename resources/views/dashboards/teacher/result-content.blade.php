@extends('layouts.dashboard.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <section class="main p-0 col-12  text-blue col-md-9  text-center">
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
                    <div class="fs-6 fw-semibold">
                        CURRENT - SESSION: {{ $currentTermSession->session->name }},
                        CURRENT - TERM: {{ $currentTermSession->name }}
                    </div>
                    <div class="fs-7">Enter/Modify result content for this current session/term</div>
                </div>
            @else
                <div class="alert alert-warning">
                    No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                </div>
            @endif
            <!-- Class comment -->
            <div class="container mt-4">
                @if($isClassTeacher)
                    <form action="{{ route('save.result.content') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row g-3 my-4">
                            <!-- School Open  -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="schoolOpen" class="text-capitalize fs-9 form-label">School Open</label>
                                <input type="date" name="school_open" id="school_open"  @if($settings)value="{{ $settings->school_open }}" @endif placeholder="School Open" class="form-control form-control-sm" required />
                                @error('school_open')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Number in Class  -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="numberInClass" class="text-capitalize fs-9 form-label">Number in class</label>
                                <input type="Number" required name="number_in_class" @if($settings)value="{{ $settings->number_in_class }}" @endif id="number_in_class" placeholder="Numbers in class" class="form-control form-control-sm" />
                                @error('number_in_class')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Term End  -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="termEnd" class="text-capitalize fs-9 form-label">Term End</label>
                                <input type="date" name="term_ends" id="termEnd" value="{{ $currentTermSession->end_date ?? '' }}" class="form-control form-control-sm" required />
                                @error('term_ends')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Next Term Begin and Class teacher Name  -->
                        <div class="row g-3 my-4">

                            <!-- Next Term Begin  -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="termStart" class="text-capitalize fs-9 form-label">Next Term Begin</label>
                                <input type="date" id="termStart" name="term_begins" @if($settings)value="{{ $settings->term_begins }}" @endif class="form-control form-control-sm" required />
                                @error('term_begins')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Class Teacher Name -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="tecaherName" class="text-capitalize fs-9 form-label">Class Teacher Name</label>
                                <input type="text" name="class_teacher_name" id="tecaherName" value="{{ $auth->firstname }} {{ $auth->lastname }}" readonly class="form-control form-control-sm" required />
                                @error('class_teacher_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Class Teacher Name -->
                            <div class="my-1 col-12 col-md-4 text-start">
                                <label for="tecaherName" class="text-capitalize fs-9 form-label">Directors Name</label>
                                <input type="text" name="directors_name" @if($settings)value="{{ $settings->directors_name }}" @endif placeholder="Directors name" class="form-control form-control-sm" required />
                                @error('directors_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <input type="hidden" name="class_id" value="{{ $classTeacherClass->id }}">


                        <div class="col-12 my-5">
                            <button type="submit" class="btn btn-primary">Save Content</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning">
                        You are not assigned to a class as a class teacher.
                    </div>
                @endif
            </div>
        </div>
    </section>


@endsection
