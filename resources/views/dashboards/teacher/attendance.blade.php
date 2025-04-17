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
                    <div class="fs-6 fw-semibold">CURRENT - SESSION: {{ $currentTermSession->session->name }}, TERM: {{ $currentTermSession->name }}</div>
                    <div class="fs-7">Enter/Modify attendance for Students in your assigned class as class teacher for current session/term
                    </div>
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
                    @if ($isClassTeacher)

                        <form action="{{ route('attendance.store') }}" method="POST" class="mb-4">
                            @csrf

                            <input type="hidden" name="teacher_id" value="{{ $teacherId }}">
                            <input type="hidden" name="class_id" value="{{ $classTeacherClass->id }}">


                            <div class="row g-3 mb-4">
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
                            </div>
                            <div class="row g-3">
                                @foreach ($studentsUnderClassteacher as $val)
                                    <input type="hidden" name="student_id[]" value="{{ $val->id }}">

                                    <!-- Student 1 -->
                                    <div class="col-md-4">
                                        <div class="text-blue px-2 text-uppercase text-start student-score-entry border p-2 rounded">
                                            <div id="student-name" class="pt-2 fs-6">
                                                {{ $val->firstname }}{{ $val->middlename ?? '' }} {{ $val->lastname }}
                                            </div>
                                            <div class="fs-7">
                                                <span class="px-1">|</span><span>{{ $val->sex }}</span>
                                            </div>
                                            <div class="my-1">
                                                <label for="attendance" class="text-capitalize fs-9 form-label">Number of times present</label>
                                                <input type="number" class="form-control form-control-sm attendance-input" name="times_present[]"
                                                required
                                            />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 my-5">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            You are not assigned to a class as a class teacher.
                        </div>
                    @endif

                </div>
            @endif
        </div>
    </section>


@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sessionSelect = document.querySelector('select[name="session_id"]');
        const termSelect = document.querySelector('select[name="term_id"]');
        const classId = document.querySelector('input[name="class_id"]').value;
        const teacherId = document.querySelector('input[name="teacher_id"]').value;

        function fetchAttendanceData() {
            const sessionId = sessionSelect.value;
            const termId = termSelect.value;

            if (sessionId && termId) {
                fetch(`attendance/fetch?class_id=${classId}&session_id=${sessionId}&term_id=${termId}`)
                    .then(res => res.json())
                    .then(data => {
                        // Map attendance by student_id
                        const attendanceMap = {};
                        data.forEach(att => {
                            attendanceMap[att.student_id] = att.times_present;
                        });

                        // Set input values accordingly
                        document.querySelectorAll('.attendance-input').forEach((input, index) => {
                            const studentId = document.getElementsByName('student_id[]')[index].value;
                            if (attendanceMap[studentId] !== undefined) {
                                input.value = attendanceMap[studentId];
                                input.required = false; // Already exists, so not required
                            } else {
                                input.value = '';
                                input.required = true; // New entry
                            }
                        });
                    });
            }
        }

        sessionSelect.addEventListener('change', fetchAttendanceData);
        termSelect.addEventListener('change', fetchAttendanceData);
    });
</script>

