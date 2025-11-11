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
        .modal-header.bg-warning {
            border-bottom: 1px solid #ffc107;
        }
        .alert-warning {
            border-left: 4px solid #ffc107;
        }
        .class-promotion-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .table-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }
        .border-start {
            border-left: 3px solid #dc3545 !important;
        }
        .table-container {
            height: 500px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .bulk-actions {
            background: linear-gradient(135deg, #6f42c1 0%, #5a6268 100%);
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .student-checkbox {
            cursor: pointer;
        }
        .selected-row {
            background-color: rgba(111, 66, 193, 0.1) !important;
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
    </style>


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

            <!-- Class Promotion Section -->
            <div class="card mb-4 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📈 Automatic Class Promotion System</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Automatic Promotion -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-2">Global Student Promotion</h6>
                                    <p class="text-muted mb-0 small">
                                        Automatically move ALL students across ALL classes to their next level.
                                        SS3 students will be flagged for graduation.
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <form action="{{ route('students.promote.all') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3" onclick="return confirmGlobalPromotion()">
                                            🚀 Promote All
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Rollback Promotion -->
                        <div class="col-md-3">
                            <div class="border-start ps-3">
                                <h6 class="fw-bold text-warning">⏪ Rollback Promotion</h6>
                                <p class="small text-muted mb-2">
                                    @if($canRollback && $lastPromotionBatch)
                                        Undo the last promotion batch ({{ date('M j, Y g:i A', strtotime($lastPromotionBatch->promoted_at)) }})
                                    @else
                                        No recent promotions available for rollback
                                    @endif
                                </p>
                                @if($canRollback && $lastPromotionBatch)
                                    <form action="{{ route('students.rollback.promotion') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm w-100" onclick="return confirmRollback()">
                                            ⏪ Rollback Last Promotion
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm w-100" disabled>
                                        ⏪ Rollback Not Available
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- View Graduated Students -->
                        <div class="col-md-3">
                            <div class="border-start ps-3">
                                <h6 class="fw-bold text-success">🎓 Graduated Students</h6>
                                <p class="small text-muted mb-2">View and manage students who have graduated from the school.</p>
                                <a href="{{ route('graduated-students.index') }}" class="btn btn-success btn-sm w-100">
                                    �️ View Graduated Students
                                </a>
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
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </span>
                                <input type="text" id="myInput" placeholder="Search students by name..."
                                       onkeyup="myFunction()" class="form-control" />
                            </div>
                        </div>

                        <!-- Class Filter Section -->
                        <div class="col-md-4">
                            <select id="classname" name="class_id" class="form-select">
                                <option value="">🏫 All Classes</option>
                                @foreach ($classes as $class)
                                    @php
                                        $totalCount = $studentCounts->get($class->id)?->first()?->count ?? 0;
                                    @endphp
                                    <option value="{{ $class->id }}">
                                        {{ $class->class_name }}
                                        ({{ $totalCount }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Control Buttons -->
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-secondary btn-sm" onclick="resetStudentFilters()">
                                    🔄 Reset
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="exportStudents()" title="Export to CSV">
                                    📊 Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Count Display -->
            <div id="studentCountDisplay" class="mb-3" style="display: none;">
                <div class="row text-center g-2">
                    <div class="col-md-6">
                        <div class="card border-primary h-100">
                            <div class="card-body py-2">
                                <h6 class="card-title text-primary mb-1">📚 Students in Class</h6>
                                <h4 class="text-primary mb-0" id="activeStudentCount">0</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success h-100">
                            <div class="card-body py-2">
                                <h6 class="card-title text-success mb-1">🎓 View Graduated Students</h6>
                                <a href="{{ route('graduated-students.index') }}" class="btn btn-success btn-sm mt-1">
                                    View All Graduates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bulk Actions Section -->
            <div id="bulkActionsSection" class="bulk-actions p-3 mb-3 rounded" style="display: none;">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="text-white">
                            <h6 class="mb-1">📋 Bulk Actions</h6>
                            <small id="selectedCount">0 students selected</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select id="bulkMoveToClass" class="form-select">
                            <option value="">Select destination class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-warning btn-sm flex-fill" onclick="bulkMoveStudents()">
                                📝 Move Selected
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="selectAllStudents()">
                                ☑️ All
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="clearSelection()">
                                ❌ Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table id="myTable" class="table table-striped table-hover mb-0">
                    <thead class="table-dark sticky-header">
                        <tr>
                            <th scope="col">
                                <input type="checkbox" id="selectAllCheckbox" class="form-check-input" onchange="toggleAllStudents()">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Class</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $students as $k=>$val )
                            <tr data-class-id="{{ $val->currentClassApplying->id }}"
                                id="student-row-{{ $val->id }}">
                                <td>
                                    <input type="checkbox" class="form-check-input student-checkbox"
                                           value="{{ $val->id }}"
                                           data-student-name="{{ $val->firstname }} {{ $val->lastname }}"
                                           onchange="updateBulkActions()">
                                </td>
                                <th scope="row">{{ ++$k }}</th>
                                <td>{{ $val->firstname }}</td>
                                <td>{{ $val->lastname }}</td>
                                <td>{{ $val->sex }}</td>
                                <td>{{ $val->currentClassApplying->class_name }}</td>
                                <td>
                                    <a href="{{ url('admin/student-detail/'.$val->id) }}" class="btn btn-sm btn-info mb-1">View</a>
                                    @if(!$currentTermSession || !$currentTermSession->session)
                                        <a href="#" class="btn btn-sm btn-secondary mb-1">Result Not-set</a>
                                    @else
                                        <form action="{{ route('view.result') }}" method="POST" target="_blank" class="d-inline">
                                            @csrf

                                            <input type="hidden" name="student_id" value="{{ $val->id }}">
                                            <input type="hidden" name="class_id" value="{{ $val->currentClassApplying->id }}" required>
                                            <input type="hidden" name="session_id" value="{{ $currentTermSession->session->id }}" required>
                                            <input type="hidden" name="term_id" value="{{ $currentTermSession->id }}" required>
                                            @if ($settings && $settings->open_result == 0)
                                                <a href="#" class="btn btn-sm btn-secondary mb-1">Result Not-set</a>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-secondary mb-1">View Results</button>
                                            @endif
                                        </form>
                                    @endif

                                    <!-- Individual Demotion Button -->
                                    <button onclick="showDemoteModal({{ $val->id }}, '{{ $val->firstname }} {{ $val->lastname }}', {{ $val->currentClassApplying->id }})"
                                            class="btn btn-sm btn-warning mb-1" title="Move to different class">
                                        📝 Move
                                    </button>

                                    <button onclick="confirmDelete({{ $val->id }})" class="btn btn-sm btn-danger mb-1">Delete</button>
                                    <form id="delete-form-{{ $val->id }}" action="{{ route('student.delete', $val->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Student Records Not Available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Individual Student Move Modal -->
    <div class="modal fade" id="demoteModal" tabindex="-1" aria-labelledby="demoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="demoteModalLabel">
                        📝 Move Student to Different Class
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="demoteForm" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            ⚠️ You are about to move <strong id="studentName"></strong> to a different class.
                        </div>
                        <div class="mb-3">
                            <label for="moveToClass" class="form-label fw-bold">Move to Class:</label>
                            <select id="moveToClass" name="to_class_id" class="form-select" required>
                                <option value="">Select target class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            📝 Move Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<script>
    function confirmDelete(studentId) {
        if (confirm("Are you sure you want to delete this record? This action cannot be undone!")) {
            document.getElementById('delete-form-' + studentId).submit();
        }
    }

    function confirmGlobalPromotion() {
        return confirm('🚀 GLOBAL PROMOTION ALERT 🚀\n\nThis will automatically promote ALL students across ALL classes to their next level:\n\n• CRECHE → PRE KG\n• PRE KG → KG 1\n• KG 1 → KG 2\n• ... and so on\n• SS3 students will be flagged for graduation\n\nThis action cannot be undone!\n\nAre you sure you want to proceed?');
    }

    function confirmRollback() {
        return confirm('⏪ ROLLBACK PROMOTION ALERT ⏪\n\nThis will UNDO the last global promotion and move ALL students back to their previous classes:\n\n• Students will return to their original classes\n• Graduated students will be moved back from graduated_students table\n• This will restore the system to the state before the last promotion\n\nAre you sure you want to rollback the last promotion?');
    }

    function showDemoteModal(studentId, studentName, currentClassId) {
        document.getElementById('studentName').textContent = studentName;
        document.getElementById('demoteForm').action = `/admin/demote-student/${studentId}`;

        // Hide current class from options
        const selectElement = document.getElementById('moveToClass');
        Array.from(selectElement.options).forEach(option => {
            if (option.value == currentClassId) {
                option.style.display = 'none';
            } else {
                option.style.display = 'block';
            }
        });
        selectElement.value = '';

        const modal = new bootstrap.Modal(document.getElementById('demoteModal'));
        modal.show();
    }

    // Student count data from PHP
    const studentCountsData = @json($studentCounts);

    function updateStudentCounts(classId) {
        const countsForClass = studentCountsData[classId] || [];
        let activeCount = 0;

        countsForClass.forEach(item => {
            activeCount = item.count;
        });

        document.getElementById('activeStudentCount').textContent = activeCount;

        const display = document.getElementById('studentCountDisplay');
        if (classId) {
            display.style.display = 'block';
        } else {
            display.style.display = 'none';
        }
    }

    // Bulk selection functionality
    function toggleAllStudents() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');

        studentCheckboxes.forEach(checkbox => {
            if (checkbox.closest('tr').style.display !== 'none') {
                checkbox.checked = selectAllCheckbox.checked;
                toggleRowSelection(checkbox);
            }
        });

        updateBulkActions();
    }

    function selectAllStudents() {
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        studentCheckboxes.forEach(checkbox => {
            if (checkbox.closest('tr').style.display !== 'none') {
                checkbox.checked = true;
                toggleRowSelection(checkbox);
            }
        });
        updateBulkActions();
    }

    function clearSelection() {
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
            toggleRowSelection(checkbox);
        });
        document.getElementById('selectAllCheckbox').checked = false;
        updateBulkActions();
    }

    function toggleRowSelection(checkbox) {
        const row = checkbox.closest('tr');
        if (checkbox.checked) {
            row.classList.add('selected-row');
        } else {
            row.classList.remove('selected-row');
        }
    }

    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.student-checkbox:checked');
        const selectedCount = Array.from(selectedCheckboxes).filter(cb =>
            cb.closest('tr').style.display !== 'none'
        ).length;

        const bulkActionsSection = document.getElementById('bulkActionsSection');
        const selectedCountDisplay = document.getElementById('selectedCount');

        if (selectedCount > 0) {
            bulkActionsSection.style.display = 'block';
            selectedCountDisplay.textContent = `${selectedCount} student${selectedCount !== 1 ? 's' : ''} selected`;
        } else {
            bulkActionsSection.style.display = 'none';
        }

        // Update select all checkbox state
        const visibleCheckboxes = Array.from(document.querySelectorAll('.student-checkbox')).filter(cb =>
            cb.closest('tr').style.display !== 'none'
        );
        const visibleCheckedCount = visibleCheckboxes.filter(cb => cb.checked).length;
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');

        if (visibleCheckedCount === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (visibleCheckedCount === visibleCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
        }
    }

    function bulkMoveStudents() {
        const selectedCheckboxes = document.querySelectorAll('.student-checkbox:checked');
        const selectedStudentIds = Array.from(selectedCheckboxes).filter(cb =>
            cb.closest('tr').style.display !== 'none'
        ).map(cb => cb.value);

        const moveToClassSelect = document.getElementById('bulkMoveToClass');
        const toClassId = moveToClassSelect.value;

        if (selectedStudentIds.length === 0) {
            alert('Please select at least one student to move.');
            return;
        }

        if (!toClassId) {
            alert('Please select a class to move the students to.');
            return;
        }

        const selectedNames = Array.from(selectedCheckboxes).filter(cb =>
            cb.closest('tr').style.display !== 'none'
        ).map(cb => cb.dataset.studentName);

        const toClassName = moveToClassSelect.options[moveToClassSelect.selectedIndex].text;

        let confirmMessage = `Are you sure you want to move ${selectedStudentIds.length} student${selectedStudentIds.length !== 1 ? 's' : ''} to ${toClassName}?\n\n`;
        confirmMessage += `Students to move:\n${selectedNames.slice(0, 5).join('\n')}`;
        if (selectedNames.length > 5) {
            confirmMessage += `\n... and ${selectedNames.length - 5} more`;
        }
        confirmMessage += '\n\nThis action cannot be undone!';

        if (confirm(confirmMessage)) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("students.bulk.move") }}';

            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Add class ID
            const classInput = document.createElement('input');
            classInput.type = 'hidden';
            classInput.name = 'to_class_id';
            classInput.value = toClassId;
            form.appendChild(classInput);

            // Add student IDs
            selectedStudentIds.forEach(studentId => {
                const studentInput = document.createElement('input');
                studentInput.type = 'hidden';
                studentInput.name = 'student_ids[]';
                studentInput.value = studentId;
                form.appendChild(studentInput);
            });

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Export functionality
    function exportStudents() {
        const table = document.getElementById('myTable');
        const visibleRows = Array.from(table.querySelectorAll('tbody tr')).filter(row =>
            row.style.display !== 'none' && row.cells.length > 1
        );

        if (visibleRows.length === 0) {
            alert('No students to export. Please adjust your filters.');
            return;
        }

        let csv = 'First Name,Last Name,Gender,Class,Status\n';

        visibleRows.forEach(row => {
            const cells = row.cells;
            const firstName = cells[2].textContent.trim();
            const lastName = cells[3].textContent.trim();
            const gender = cells[4].textContent.trim();
            const className = cells[5].textContent.trim();
            const status = cells[6].textContent.trim().replace(/[🎓✅📚]/g, '').trim();

            csv += `"${firstName}","${lastName}","${gender}","${className}","${status}"\n`;
        });

        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `students_export_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
        window.URL.revokeObjectURL(url);
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const classFilter = document.getElementById("classname");
        const studentRows = document.querySelectorAll("#myTable tbody tr");

        function filterStudentsByClass() {
            const selectedClassId = classFilter.value;

            studentRows.forEach(row => {
                const matchesClass = !selectedClassId || row.dataset.classId === selectedClassId;
                row.style.display = matchesClass ? "" : "none";
            });

            // Update student counts
            updateStudentCounts(selectedClassId);

            // Update bulk actions after filtering
            updateBulkActions();
        }

        classFilter.addEventListener("change", filterStudentsByClass);

        // Initialize bulk actions
        document.querySelectorAll('.student-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleRowSelection(this);
                updateBulkActions();
            });
        });
    });

    function resetStudentFilters() {
        document.getElementById("classname").value = "";
        document.getElementById("myInput").value = "";
        document.querySelectorAll("#myTable tbody tr").forEach(row => {
            row.style.display = "";
        });

        // Hide student count display
        document.getElementById('studentCountDisplay').style.display = 'none';

        // Clear all selections
        clearSelection();
    }

    // Search functionality
    function myFunction() {
        const input = document.getElementById("myInput");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("myTable");
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // Start from 1 to skip header
            const tdFirst = tr[i].getElementsByTagName("td")[2]; // First name (index 2 due to checkbox)
            const tdLast = tr[i].getElementsByTagName("td")[3];  // Last name (index 3 due to checkbox)

            if (tdFirst && tdLast) {
                const txtValueFirst = tdFirst.textContent || tdFirst.innerText;
                const txtValueLast = tdLast.textContent || tdLast.innerText;
                const fullName = (txtValueFirst + " " + txtValueLast).toUpperCase();

                if (fullName.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Update bulk actions after search
        updateBulkActions();
    }
</script>


