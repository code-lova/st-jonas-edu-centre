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
          <!-- Class comment -->
          <div class="container mt-4">
                <form action="{{ route('create.teacher.comment') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="session_id" class="form-select" required>
                                <option value="">Select a session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="term_id" class="form-select" required>
                                <option value="">Select a term</option>
                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}" {{ old('term_id') == $term->id ? 'selected' : '' }}>{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="class_id" id="student" class="form-select" required>
                                <option value="">Select student class</option>
                                @foreach($classAssigned as $class)
                                    <option value="{{ $class->class_id }}" {{ old('class_id') == $class->class_id ? 'selected' : '' }}>{{ $class->class->class_name }}</option>
                                @endforeach
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
        </div>
    </section>



@endsection


