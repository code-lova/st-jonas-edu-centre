@extends('layouts.dashboard.admin.layout')

@section('content')
    <style>
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .stats-card {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 12px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .filter-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .table-container {
            height: 600px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .graduation-badge {
            background: linear-gradient(45deg, #ffd700, #ffed4a);
            color: #333;
            font-weight: bold;
        }
        .sort-btn {
            background: none;
            border: none;
            color: white;
            text-decoration: none;
        }
        .sort-btn:hover {
            color: #ffc107;
        }
        .sort-btn.active {
            color: #ffc107;
        }
    </style>

    <section class="main p-0 col-12 text-red col-md-9 text-center">
        <div class="main-body overflow-auto vh-100">
            <!-- Header -->
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button" aria-controls="mobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <div class="fs-6 fw-bold text-red align-self-center">🎓 Graduated Students</div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $graduationStats['total_graduates'] }}</h3>
                        <p class="mb-0">Total Graduates</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $graduationStats['current_year_graduates'] }}</h3>
                        <p class="mb-0">Current Year</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <h3>{{ $academicYears->count() }}</h3>
                        <p class="mb-0">Academic Years</p>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="card filter-card">
                <div class="card-body py-3">
                    <form method="GET" action="{{ route('graduated-students.index') }}" id="filterForm">
                        <div class="row align-items-end">
                            <!-- Search -->
                            <div class="col-md-4 mb-2">
                                <label class="form-label fw-bold">🔍 Search Students</label>
                                <input type="text" name="search" value="{{ $currentFilters['search'] }}"
                                       class="form-control" placeholder="Search by name or email...">
                            </div>

                            <!-- Academic Year Filter -->
                            <div class="col-md-3 mb-2">
                                <label class="form-label fw-bold">📅 Academic Year</label>
                                <select name="academic_year" class="form-select">
                                    <option value="">All Years</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year }}" {{ $currentFilters['academic_year'] == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class Filter -->
                            <div class="col-md-3 mb-2">
                                <label class="form-label fw-bold">🏫 Graduated From</label>
                                <select name="class_id" class="form-select">
                                    <option value="">All Classes</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" {{ $currentFilters['class_id'] == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-2 mb-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">🔍 Filter</button>
                                    <a href="{{ route('graduated-students.index') }}" class="btn btn-outline-secondary btn-sm">🔄 Reset</a>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden sort fields -->
                        <input type="hidden" name="sort_by" value="{{ $currentFilters['sort_by'] }}">
                        <input type="hidden" name="sort_direction" value="{{ $currentFilters['sort_direction'] }}">
                    </form>
                </div>
            </div>

            <!-- Export and Actions -->
            <div class="card mb-3">
                <div class="card-body py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">{{ $graduatedStudents->total() }} graduated students found</span>
                            @if($currentFilters['search'] || $currentFilters['academic_year'] || $currentFilters['class_id'])
                                <span class="text-muted">(filtered)</span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('graduated-students.export', request()->query()) }}"
                               class="btn btn-success btn-sm">
                                📊 Export CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graduated Students Table -->
            <div class="table-container">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark sticky-header">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <button type="button" class="sort-btn {{ $currentFilters['sort_by'] == 'firstname' ? 'active' : '' }}"
                                        onclick="sortTable('firstname')">
                                    First Name
                                    @if($currentFilters['sort_by'] == 'firstname')
                                        @if($currentFilters['sort_direction'] == 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                            </th>
                            <th scope="col">
                                <button type="button" class="sort-btn {{ $currentFilters['sort_by'] == 'lastname' ? 'active' : '' }}"
                                        onclick="sortTable('lastname')">
                                    Last Name
                                    @if($currentFilters['sort_by'] == 'lastname')
                                        @if($currentFilters['sort_direction'] == 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                            </th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Graduated From</th>
                            <th scope="col">
                                <button type="button" class="sort-btn {{ $currentFilters['sort_by'] == 'academic_year' ? 'active' : '' }}"
                                        onclick="sortTable('academic_year')">
                                    Academic Year
                                    @if($currentFilters['sort_by'] == 'academic_year')
                                        @if($currentFilters['sort_direction'] == 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                            </th>
                            <th scope="col">
                                <button type="button" class="sort-btn {{ $currentFilters['sort_by'] == 'graduation_date' ? 'active' : '' }}"
                                        onclick="sortTable('graduation_date')">
                                    Graduation Date
                                    @if($currentFilters['sort_by'] == 'graduation_date')
                                        @if($currentFilters['sort_direction'] == 'asc') ↑ @else ↓ @endif
                                    @endif
                                </button>
                            </th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($graduatedStudents as $index => $student)
                            <tr>
                                <th scope="row">{{ $graduatedStudents->firstItem() + $index }}</th>
                                <td>{{ $student->firstname }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->sex }}</td>
                                <td>
                                    <span class="badge graduation-badge">
                                        {{ $student->graduatedFromClass->class_name }}
                                    </span>
                                </td>
                                <td>{{ $student->academic_year }}</td>
                                <td>{{ $student->graduation_date->format('M j, Y') }}</td>
                                <td>
                                    <a href="{{ route('graduated-students.show', $student->id) }}"
                                       class="btn btn-sm btn-info">
                                        👁️ View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <div class="text-muted">
                                        <h5>No graduated students found</h5>
                                        <p>No students match your current filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($graduatedStudents->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $graduatedStudents->links() }}
                </div>
            @endif
        </div>
    </section>

    <script>
        function sortTable(column) {
            const currentSort = document.querySelector('input[name="sort_by"]').value;
            const currentDirection = document.querySelector('input[name="sort_direction"]').value;

            let newDirection = 'asc';
            if (currentSort === column && currentDirection === 'asc') {
                newDirection = 'desc';
            }

            document.querySelector('input[name="sort_by"]').value = column;
            document.querySelector('input[name="sort_direction"]').value = newDirection;
            document.getElementById('filterForm').submit();
        }

        // Auto-submit form when select fields change
        document.querySelectorAll('select[name="academic_year"], select[name="class_id"]').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endsection
