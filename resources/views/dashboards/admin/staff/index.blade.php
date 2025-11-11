@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')
    <style>
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .btn-group-vertical .btn {
            margin-bottom: 2px;
        }
        .table td {
            vertical-align: middle;
        }
        .staff-management-section {
            background: linear-gradient(135deg, #60110a 0%, #0056b3 100%);
        }
        .table-container {
            height: 500px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .search-controls {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
        }
        .input-group-text {
            border: none;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .staff-stats {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .subject-tags {
            max-width: 300px;
        }
        .subject-tag {
            display: inline-block;
            background: #e9ecef;
            color: #495057;
            padding: 2px 8px;
            margin: 2px;
            border-radius: 12px;
            font-size: 0.75rem;
            white-space: nowrap;
        }
    </style>

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

            <!-- Staff Management Header -->
            <div class="card mb-4 border-secondary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">👥 Staff Management System</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Staff Statistics -->
                        <div class="col-md-8">
                            <div class="row text-center g-2">
                                <div class="col-md-4">
                                    <div class="card border-success h-100">
                                        <div class="card-body py-2">
                                            <h6 class="card-title text-success mb-1">👥 Total Staff</h6>
                                            <h4 class="text-success mb-0">{{ $staffs->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-info h-100">
                                        <div class="card-body py-2">
                                            <h6 class="card-title text-info mb-1">🏫 Class Teachers</h6>
                                            <h4 class="text-info mb-0">{{ $staffs->whereNotNull('class_teacher')->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-warning h-100">
                                        <div class="card-body py-2">
                                            <h6 class="card-title text-warning mb-1">📚 Subject Teachers</h6>
                                            <h4 class="text-warning mb-0">{{ $staffs->filter(function($staff) { return $staff->subjects->count() > 0; })->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="col-md-4">
                            <div class="d-flex flex-column gap-2 h-100 justify-content-center">
                                <a href="{{ route('newstaff') }}" class="btn btn-success">
                                    ➕ Add New Staff
                                </a>
                                <button class="btn btn-outline-primary" onclick="exportStaff()" title="Export to CSV">
                                    📊 Export Staff List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Controls -->
            <div class="card mb-4 border-secondary">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <!-- Search Section -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </span>
                                <input type="text" id="myInput" placeholder="Search staff by name, class, or subject..."
                                       onkeyup="myFunction()" class="form-control" />
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="col-md-3">
                            <select id="roleFilter" name="role_filter" class="form-select" onchange="filterByRole()">
                                <option value="">🎯 All Staff</option>
                                <option value="class-teacher">🏫 Class Teachers</option>
                                <option value="subject-teacher">📚 Subject Teachers</option>
                                <option value="admin">👑 Administrators</option>
                            </select>
                        </div>

                        <!-- Control Buttons -->
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-secondary btn-sm" onclick="resetFilters()">
                                    🔄 Reset
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="printStaffList()" title="Print Staff List">
                                    🖨️ Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Count Display -->
            <div id="staffCountDisplay" class="mb-3">
                <div class="card border-info">
                    <div class="card-body py-2 text-center">
                        <h6 class="card-title text-info mb-1">📊 Showing <span id="visibleStaffCount">{{ $staffs->count() }}</span> staff members</h6>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table id="myTable" class="table table-striped table-hover mb-0">
                    <thead class="table-dark sticky-header">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">👤 Name</th>
                            <th scope="col">🏫 Class Teacher</th>
                            <th scope="col">📚 Subjects/Classes</th>
                            <th scope="col">📧 Contact</th>
                            <th scope="col">🔧 Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $staffs as $k=>$val )
                            <tr data-role="{{ $val->role }}" data-has-class="{{ $val->class_teacher ? 'yes' : 'no' }}" data-has-subjects="{{ $val->subjects->count() > 0 ? 'yes' : 'no' }}">
                                <th scope="row">{{ ++$k }}</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            @if($val->passport)
                                                <img src="{{ asset('uploads/passport/' . $val->passport) }}"
                                                     class="rounded-circle" width="32" height="32"
                                                     style="object-fit: cover;" alt="Profile">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                                     style="width: 32px; height: 32px; font-size: 14px; color: white;">
                                                    {{ strtoupper(substr($val->firstname, 0, 1)) }}{{ strtoupper(substr($val->lastname, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $val->firstname }} {{ $val->lastname }}</div>
                                            @if($val->middlename)
                                                <small class="text-muted">{{ $val->middlename }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($val->class)
                                        <span class="badge bg-danger">{{ $val->class->class_name }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="subject-tags">
                                        @php
                                            $groupedSubjects = [];
                                            foreach ($val->subjects as $subject) {
                                                $groupedSubjects[$subject->subject_name][] = $subject->class->class_name ?? 'N/A';
                                            }
                                        @endphp
                                        @forelse ($groupedSubjects as $subjectName => $classes)
                                            <div class="mb-1">
                                                <span class="badge bg-danger me-1">{{ $subjectName }}</span>
                                                <small class="text-muted">{{ implode(', ', $classes) }}</small>
                                            </div>
                                        @empty
                                            <span class="text-muted">No subjects assigned</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td>
                                    @if($val->email)
                                        <a href="mailto:{{ $val->email }}" class="text-decoration-none">
                                            <small>{{ $val->email }}</small>
                                        </a>
                                    @endif
                                    @if($val->phone)
                                        <br>
                                        <a href="tel:{{ $val->phone }}" class="text-decoration-none">
                                            <small>{{ $val->phone }}</small>
                                        </a>
                                    @endif
                                    @if(!$val->email && !$val->phone)
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group-vertical" role="group">
                                        <a href="{{ url('admin/staff-detail/'.$val->id) }}" class="btn btn-sm btn-info mb-1">👁️ View</a>
                                        <a href="{{ route('update.staff', $val->id) }}" class="btn btn-sm btn-warning mb-1">✏️ Edit</a>
                                        <button onclick="confirmDelete({{ $val->id }})" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                    </div>

                                    <form id="delete-form-{{ $val->id }}" action="{{ route('staff.delete', $val->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people mb-3" viewBox="0 0 16 16">
                                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002A.274.274 0 0 1 15 13H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                        </svg>
                                        <h5>No Staff Records Available</h5>
                                        <p>Get started by adding your first staff member.</p>
                                        <a href="{{ route('newstaff') }}" class="btn btn-primary">
                                            ➕ Add Staff Member
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

<script>
    // Enhanced search function
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        let visibleCount = 0;

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            let rowText = "";

            // Combine all cell text for comprehensive search
            for (let j = 0; j < td.length; j++) {
                rowText += td[j].textContent || td[j].innerText || "";
            }

            if (rowText.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                visibleCount++;
            } else {
                tr[i].style.display = "none";
            }
        }

        updateStaffCount(visibleCount);
    }

    // Filter by role
    function filterByRole() {
        var roleFilter = document.getElementById("roleFilter").value;
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");
        let visibleCount = 0;

        for (let i = 1; i < tr.length; i++) {
            let show = false;

            if (roleFilter === "") {
                show = true;
            } else if (roleFilter === "class-teacher") {
                show = tr[i].getAttribute("data-has-class") === "yes";
            } else if (roleFilter === "subject-teacher") {
                show = tr[i].getAttribute("data-has-subjects") === "yes";
            } else if (roleFilter === "admin") {
                show = tr[i].getAttribute("data-role") === "admin";
            }

            if (show) {
                tr[i].style.display = "";
                visibleCount++;
            } else {
                tr[i].style.display = "none";
            }
        }

        updateStaffCount(visibleCount);
    }

    // Reset all filters
    function resetFilters() {
        document.getElementById("myInput").value = "";
        document.getElementById("roleFilter").value = "";

        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");
        let totalCount = 0;

        for (let i = 1; i < tr.length; i++) {
            tr[i].style.display = "";
            totalCount++;
        }

        updateStaffCount(totalCount);
    }

    // Update staff count display
    function updateStaffCount(count) {
        document.getElementById("visibleStaffCount").textContent = count;
    }

    // Export staff data to CSV
    function exportStaff() {
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tr");
        var csvContent = "data:text/csv;charset=utf-8,";

        // Add headers
        csvContent += "S/N,Name,Class Teacher,Subjects,Contact\n";

        // Add visible rows only
        for (let i = 1; i < rows.length; i++) {
            if (rows[i].style.display !== "none") {
                let cols = rows[i].getElementsByTagName("td");
                let rowData = [];

                // Extract data from specific columns
                rowData.push(rows[i].getElementsByTagName("th")[0].textContent.trim()); // S/N
                rowData.push(cols[0].textContent.replace(/\s+/g, ' ').trim()); // Name
                rowData.push(cols[1].textContent.trim()); // Class Teacher
                rowData.push(cols[2].textContent.trim()); // Subjects
                rowData.push(cols[3].textContent.replace(/\s+/g, ' ').trim()); // Contact

                csvContent += rowData.map(field => `"${field}"`).join(",") + "\n";
            }
        }

        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "staff_list_" + new Date().toISOString().split('T')[0] + ".csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Print staff list
    function printStaffList() {
        var printWindow = window.open('', '_blank');
        var table = document.getElementById("myTable").cloneNode(true);

        // Remove action column for printing
        var headerRow = table.getElementsByTagName("tr")[0];
        headerRow.deleteCell(-1);

        var rows = table.getElementsByTagName("tr");
        for (let i = 1; i < rows.length; i++) {
            if (rows[i].style.display !== "none") {
                rows[i].deleteCell(-1);
            }
        }

        printWindow.document.write(`
            <html>
                <head>
                    <title>Staff List - {{ config('app.name') }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        h1 { color: #333; text-align: center; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        tr:nth-child(even) { background-color: #f9f9f9; }
                        .header-info { text-align: center; margin-bottom: 20px; }
                    </style>
                </head>
                <body>
                    <div class="header-info">
                        <h1>{{ config('app.name') }} - Staff List</h1>
                        <p>Generated on: ${new Date().toLocaleDateString()}</p>
                    </div>
                    ${table.outerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    // Confirm delete function
    function confirmDelete(staffId) {
        if (confirm("Are you sure you want to delete this staff member? This action cannot be undone!")) {
            document.getElementById('delete-form-' + staffId).submit();
        }
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial count
        updateStaffCount({{ $staffs->count() }});

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('myInput').focus();
            }
            // Escape to reset filters
            if (e.key === 'Escape') {
                resetFilters();
            }
        });
    });
</script>
