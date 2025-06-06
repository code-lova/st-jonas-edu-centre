@extends('layouts.dashboard.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <!-- this is the end of the mobile view -->
    <section class="main p-0 col-12  text-blue col-md-9  text-center">
        <div class="main-body overflow-auto vh-100">
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button" aria-controls="mobileMenu">
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
                    <div class="fs-7">Enter comments for Students in the class you are assigned to as class teacher for this current session/term</div>
                </div>
            @else
                <div class="alert alert-warning">
                    No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                </div>
            @endif

            @if(!$currentTermSession || !$currentTermSession->session)
                <div class="alert alert-warning">
                    No active term and session set by the admin Yet.
                </div>
            @else
                <!-- Class comment -->
                <div class="container mt-4">
                    @if($isClassTeacher)
                        <form action="{{ route('create.teacher.comment') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select name="session_id" class="form-select" required>
                                        <option value="">Select a session</option>
                                        <option value="{{ $currentTermSession->session->id }}" {{ old('session_id') == $currentTermSession->session->id ? 'selected' : '' }}>{{ $currentTermSession->session->name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="term_id" class="form-select" required>
                                        <option value="">Select a term</option>
                                        <option value="{{ $currentTermSession->id }}" {{ old('term_id') == $currentTermSession->id ? 'selected' : '' }}>{{ $currentTermSession->name }}</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select name="class_id" id="student" class="form-select" required>
                                        <option value="">Select your class</option>
                                        <option value="{{ $classTeacherClass->id }}">{{ $classTeacherClass->class_name }}</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select name="student_id" id="student-select" class="form-select" required>
                                        <option value="">Select a class first</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <textarea name="comment" value="{{ old('comment') }}" id="comments" class="form-control" rows="3" placeholder="Enter your comment here" required></textarea>
                                </div>

                                <input type="hidden" name="teacher_id" value="{{ $teacherId }}">

                                <div class="col-12">
                                    <button type="submit" class="btn btn-secondary">Save Comment</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            You are not assigned to a class as a class teacher.
                        </div>
                    @endif

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Session</th>
                                    <th>Term</th>
                                    <th>Comment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $val)
                                    <tr>
                                        <td>{{ $val->student->firstname }} {{ $val->student->lastname }}
                                            ( {{ $val->student->currentClassApplying->class_name }} )
                                        </td>
                                        <td>{{ $val->session->name }}</td>
                                        <td>{{ $val->term->name }}</td>
                                        <td>{{ $val->comment }}</td>
                                        <td>
                                            <form action="{{ url('teacher/delete-comment/' . $val->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Comment Records Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>



@endsection


