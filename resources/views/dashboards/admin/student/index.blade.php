@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

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
                <div class="fs-6 fw-bold text-red align-self-center ">Students List</div>
            </div>
            <div class="my-1 col-12 col-md-4 text-start">
                <input type="text" id="myInput" id="middlename" placeholder="Search for names.."
                    onkeyup="myFunction()" class="form-control form-control-lg" />
            </div>
            <table id="myTable" class="table sortable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Class</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $students as $k=>$val )
                        <tr>
                            <th scope="row">{{ ++$k }}</th>
                            <td>{{ $val->firstname }}</td>
                            <td>{{ $val->lastname }}</td>
                            <td>{{ $val->sex }}</td>
                            <td>{{ $val->currentClassApplying->class_name }}</td>
                            <td>
                                <a href="{{ url('admin/student-detail/'.$val->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="" class="btn btn-sm btn-secondary">View Results</a>

                                <button onclick="confirmDelete({{ $val->id }})" class="btn btn-sm btn-danger">Delete</button>
                                <form id="delete-form-{{ $val->id }}" action="{{ route('student.delete', $val->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Student Records Not Available</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </section>

@endsection

<script>
    function confirmDelete(studentId) {
        if (confirm("Are you sure you want to delete this record? This action cannot be undone!")) {
            document.getElementById('delete-form-' + studentId).submit();
        }
    }
</script>
