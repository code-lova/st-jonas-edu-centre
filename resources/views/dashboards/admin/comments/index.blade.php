@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')

    <style>
        .select-container select {
            width: 100%;
            max-width: 300px;
        }
    </style>

    <!-- this is the end of the mobile view -->
    <section class="main p-0 col-12  text-red col-md-9  text-center">
        <div class="main-body overflow-auto vh-100">
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button"
                    aria-controls="mobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <div class="fs-6 fw-bold text-red align-self-center ">{{ $title }}</div>
            </div>

            <h1 class="mt-3">Select Details</h1>

            <!-- Form Container with Border and Centering -->
            <div class="container border border-red p-4 mt-3 rounded" style="max-width: 600px;">
                <form action="{{ route('create.comment') }}" method="POST">
                    @csrf

                    <!-- Session Select -->
                    <div class="form-group mb-3">
                        <label for="session" class="text-start d-block mb-2">Select Session:</label>
                        <select name="session_id" id="session" class="form-control w-100 ">
                            <option value="">Select a session</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Term Select -->
                    <div class="form-group mb-3">
                        <label for="term" class="text-start d-block mb-2">Select Term:</label>
                        <select name="term_id" id="term" class="form-control w-100">
                            <option value="">Select a term</option>
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}" {{ old('term_id') == $term->id ? 'selected' : '' }}>{{ $term->name }}</option>
                            @endforeach
                        </select>
                    </div>

                     <!-- class Select -->
                     <div class="form-group mb-3">
                        <label for="student" class="text-start d-block mb-2">Select Class:</label>
                        <select name="class_id" id="student" class="form-control w-100">
                            <option value="6">Select student class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                     <!-- show all students(users) for that class for admin to select one in the dropdown  -->
                     <div class="form-group mb-3">
                        <label for="student" class="text-start d-block mb-2">Select Student:</label>
                        <select name="user_id" id="student-select" class="form-control w-100">
                            <option value="">Select a class first</option>
                        </select>
                    </div>

                    <!-- Comments -->
                    <div class="form-group mb-3">
                        <label for="comments">Comments:</label>
                        <textarea name="comment" value="{{ old('comment') }}" id="comments" class="form-control w-100" rows="5"></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-secondary mt-3">Create Comment</button>
                </form>
            </div>
            <br>
            <br>
            <p style="font-weight: bold; font-size: 18px">Sort Comment by Session/Term</p>
            <div class="row" style="display: flex; justify-content:center;">
                <!-- first name  -->
                <div class="my-1 col-12 col-md-4 text-start">
                    <label class="pt-4" for="sessionName">Session:</label>
                    <select id="sessionName" name="session_id" class="form-select" required>
                        <option value="">Select a Session</option>
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->name }} Session</option>
                        @endforeach
                    </select>
                </div>
                <!-- middle name  -->
                <div class="my-1 col-12 col-md-4 text-start">
                    <label class="pt-4" for="sessionName">Term:</label>
                    <select id="termName" name="term_id" class="form-select" required>
                        <option value="">Select a Term</option>
                        @foreach ($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-sm btn-warning my-3" onclick="resetFilters()">Reset Table</button>

            <!-- Displayed comment Table -->
            <h2 class="mt-5">Comments List</h2>
            <div style="max-height: 400px; overflow-y: auto; margin-bottom: 100px;">
                <table class="table table-bordered mt-3">
                    <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th>Student</th>
                            <th>Session</th>
                            <th>Term</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $val)
                            <tr data-session-id="{{ $val->session_id }}" data-term-id="{{ $val->term_id }}">
                                <td>{{ $val->student->firstname }} {{ $val->student->lastname }}
                                    ( {{ $val->student->currentClassApplying->class_name }} )
                                </td>
                                <td>{{ $val->session->name }}</td>
                                <td>{{ $val->term->name }}</td>
                                <td>{{ $val->comment }}</td>
                                <td>
                                    <form action="{{ url('admin/delete-comment/' . $val->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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
    </section>



@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const classDropdown = document.getElementById("student"); // class dropdown
        const studentDropdown = document.getElementById("student-select");
        const oldUserId = "{{ old('user_id') }}";

        //Sorting functionality - VARABLES
        const sessionFilter = document.getElementById("sessionName");
        const termFilter = document.getElementById("termName");
        const rows = document.querySelectorAll("table tbody tr");


        function fetchStudentsAndSelectOld(classId) {
            studentDropdown.innerHTML = '<option value="">Loading students...</option>';

            fetch(`students-by-class?class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    studentDropdown.innerHTML = '<option value="">Select student</option>';
                    data.forEach(student => {
                        const isSelected = student.id == oldUserId ? 'selected' : '';
                        studentDropdown.innerHTML += `
                            <option value="${student.id}" ${isSelected}>
                                ${student.firstname.toUpperCase()} ${student.lastname.toUpperCase()}
                            </option>
                        `;
                    });
                })
                .catch(error => {
                    console.error("Error fetching students:", error);
                    studentDropdown.innerHTML = '<option value="">Failed to load students</option>';
                });
        }

        classDropdown.addEventListener("change", function () {
            const classId = this.value;
            if (classId) {
                fetchStudentsAndSelectOld(classId);
            } else {
                studentDropdown.innerHTML = '<option value="">Select a class first</option>';
            }
        });

        // Auto-fetch students if class was previously selected
        const oldClassId = "{{ old('class_id') }}";
        if (oldClassId) {
            classDropdown.value = oldClassId;
            fetchStudentsAndSelectOld(oldClassId);
        }

        //SORTING FUNCTION FOR COMMENT TABLE
        function filterTable() {
            const sessionId = sessionFilter.value;
            const termId = termFilter.value;

            rows.forEach(row => {
                const matchesSession = !sessionId || row.dataset.sessionId === sessionId;
                const matchesTerm = !termId || row.dataset.termId === termId;

                if (matchesSession && matchesTerm) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        sessionFilter.addEventListener("change", filterTable);
        termFilter.addEventListener("change", filterTable);
    });

     //FUNCTION TO RESET TABLE TO SEE ALL DATA FROM DATABASE
    function resetFilters() {
        document.getElementById("sessionName").value = "";
        document.getElementById("termName").value = "";
        document.querySelectorAll("table tbody tr").forEach(row => {
            row.style.display = "";
        });

    }
</script>


