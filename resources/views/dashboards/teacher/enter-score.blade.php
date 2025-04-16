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
            <div class="bg-light vh-100 text-blue rounded">
                @if ($currentTermSession && $currentTermSession->session)
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold">SUBJECT: <span class="fw-bolder">{{ $subject->subject_name }}</span>, SESSION: {{ $session->name }}, TERM: {{ $term->name }}</div>
                        <div class="fs-7">Enter/Modify Scores for Students in this class and click anywhere to save changes
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                    </div>
                @endif

                <!-- Student detals for scoresx input -->
                <div class="d-grid p-0 gap-4" id="scores-container">
                    <form method="POST" action="{{ route('teacher.save_scores') }}">
                        @csrf

                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <input type="hidden" name="term_id" value="{{ $termId }}">
                        <input type="hidden" name="class_id" value="{{ $classId }}">
                        <input type="hidden" name="subject_id" value="{{ $subjectId }}">
                        <input type="hidden" name="teacher_id" value="{{ $teacherId }}">

                        @foreach ($students as $student)

                            <div class="text-blue px-2 text-uppercase text-start student-score-entry" >
                                <div id="student-name" class="pt-2 fs-6">
                                    {{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }}
                                </div>
                                <div class="fs-7">
                                    <span class="px-1">|</span><span class="">{{ $student->sex }}</span>
                                </div>

                                <div class="row pb-4 justify-content-between">
                                    <div class="col-12 col-lg-4">
                                        <label for="test1" class="form-label text-capitalize fs-7">Test 1</label>
                                        <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][first_test]"
                                               value="{{ number_format($scoreData[$student->id]->first_test ?? 0, 0) }}" min="0" max="20" required>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="test2" class="form-label text-capitalize fs-6">Test 2</label>
                                        <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][second_test]"
                                               value="{{ number_format($scoreData[$student->id]->second_test ?? 0, 0) }}" min="0" max="20" required>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="exam" class="form-label text-capitalize fs-6">Exam</label>
                                        <input type="number" class="form-control score-input" name="scores[{{ $student->id }}][exam]"
                                               value="{{ number_format($scoreData[$student->id]->exam ?? 0, 0) }}" min="0" max="60" required>
                                    </div>
                                </div>
                                <input type="hidden" name="scores[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                            </div>
                        @endforeach
                        {{-- <button type="submit" class="btn btn-secondary">Save Scores</button> --}}
                    </form>

                </div>
            </div>
        </div>
    </section>


@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.score-input');

        inputs.forEach(input => {
            input.addEventListener('change', function () {
                const entryDiv = input.closest('.student-score-entry');
                const studentId = entryDiv.querySelector('input[name$="[student_id]"]').value;
                const firstTest = entryDiv.querySelector('input[name$="[first_test]"]').value;
                const secondTest = entryDiv.querySelector('input[name$="[second_test]"]').value;
                const exam = entryDiv.querySelector('input[name$="[exam]"]').value;

                const data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                data.append('session_id', '{{ $sessionId }}');
                data.append('term_id', '{{ $termId }}');
                data.append('class_id', '{{ $classId }}');
                data.append('subject_id', '{{ $subjectId }}');
                data.append('teacher_id', '{{ $teacherId }}');
                data.append(`scores[${studentId}][student_id]`, studentId);

                // Only send updated values
                if (firstTest) {
                    data.append(`scores[${studentId}][first_test]`, firstTest);
                }
                if (secondTest && secondTest !== "0") {
                    data.append(`scores[${studentId}][second_test]`, secondTest);
                }
                if (exam && exam !== "0") {
                    data.append(`scores[${studentId}][exam]`, exam);
                }

                fetch("{{ route('teacher.save_scores') }}", {
                    method: 'POST',
                    body: data,
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(result => {
                    alert(result.message); // Show success message
                })
                .catch(error => {
                    alert('Error saving score.');
                    console.error('Error:', error);
                });
            });
        });
    });
</script>







