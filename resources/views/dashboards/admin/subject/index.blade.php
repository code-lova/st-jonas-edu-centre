@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')
    <style>

        table {
            width: 100%;
            border-collapse: collapse;

        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        input{
            border: 1px solid #151515;
        }
        /* Modal styles */
        .class-modal {
            display: none;
            position: fixed ;
            z-index: 1 ;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            padding-top: 60px;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .close {
            color: #65001879;
            font-size: 28px;
            font-weight: bold;
            width: 0%;
            background-color: green;
        }
        .close:hover,
        .close:focus {
            color: #650018;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            text-align: center;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
            background-color: #fefefe;
            margin: 5% auto;
            border: 1px solid #888;
            width: 60%;
        }

        /* Input and button styles */
        .modal-content input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
            outline: none;
        }

        .modal-content select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
            outline: none;
        }

        .modal-content input:focus {
            border-color: #650018;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        .modal-content label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Button Styles */
        .modal-content button {
            width: 100%;
            background: #650018;
            color: #fff;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .modal-content button:hover {
            background: #650018;
        }

        .pagination .page-item .page-link {
            background-color: #650018 !important;
            color: white !important;
            border-color: #650018 !important;
        }

        .pagination .page-item .page-link:hover {
            background-color: #fff !important;
            border-color: darkred !important;
            color: #650018 !important;
        }

        .hide-pagination {
            display: none;
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
                <div class="fs-6 fw-bold text-red align-self-center "> {{ $title }}</div>
            </div>
            <h1>Subject List</h1>

            <!-- Create Class Button -->
            <button class="btn btn-secondary btn-sm fs-7 mt-4 mb-4" id="create-sc">Create Subject</button>


            <!-- Table detail -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subjects</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                   @forelse ($subject as $k=>$val)
                    <tr data-class-id="{{ $val->class_id }}">
                        <td>{{ ++$k }}</td>
                        <td>{{ $val->subject_name }}</td>
                        <td>{{ $val->class->class_name }}</td>
                        <td>
                            <button class="btn btn-secondary btn-sm fs-7 edit-sc"
                                data-id="{{ $val->id }}"
                                data-name="{{ $val->subject_name }}"
                                data-class-id="{{ $val->class_id }}">
                                Edit
                            </button>
                            <button disabled class="btn btn-secondary btn-sm fs-7 delete-sc" data-id="{{ $val->id }}">Delete</button>
                        </td>
                    </tr>
                   @empty
                        <tr>
                            <td colspan="4" class="text-center">No Subject Records Available</td>
                        </tr>
                   @endforelse

                </tbody>

            </table>
             <!-- Pagination -->
                <ul class="pagination justify-content-center mt-4 mb-4">
                    {{ $subject->links() }}
                </ul>
            <!-- Paginations end -->


            <!-- Create subject Modal -->
            <div id="createModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeCreateModal">&times;</span>
                    <h2>Create Class</h2>
                    <form action="{{ route('create.subject') }}" id="createForm" method="POST">
                        @csrf
                        <label for="className">Subject Name:</label>
                        <input type="text" id="className" value="{{ old('subject_name') }}" name="subject_name" required><br><br>
                        <label for="className">Class Name:</label>
                        <select name="class_id" id="">
                            <option value="">Select a Class</option>
                            @foreach ($classes as $val)
                                <option value="{{ $val->id }}" {{ old('class_id') == $val->id ? 'selected' : '' }}>{{ $val->class_name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-secondary btn-sm fs-7">Create Subject</button>
                    </form>
                </div>
            </div>

            <!-- Edit Subject Modal -->
            <div id="editModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeEditModal">&times;</span>
                    <h2>Edit Subject</h2>
                    <form id="editClassForm">
                        <label for="editName">Subject Name:</label>
                        <input type="text" id="editName" name="editName" required><br><br>

                        <label for="editClass">Class Name:</label>
                        <select name="class_id" id="editClass">
                            <option value="">Select a Class</option>
                            @foreach ($classes as $val)
                                <option value="{{ $val->id }}">{{ $val->class_name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-secondary btn-sm fs-7" id="saveChanges">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get modal elements
        const createModal = document.getElementById("createModal");
        const editModal = document.getElementById("editModal");

        // Get open modal buttons
        const createBtn = document.getElementById("create-sc");
        const editBtns = document.querySelectorAll(".edit-sc");
        const deleteBtns = document.querySelectorAll(".delete-sc");
        const pagination = document.querySelector(".pagination");

        // Get close buttons
        const closeCreateModal = document.getElementById("closeCreateModal");
        const closeEditModal = document.getElementById("closeEditModal");

        // Input fields in the modals
        const editNameInput = document.getElementById("editName");
        const editClassSelect = document.getElementById("editClass");

        let selectedSubjectId = null;

        // Open create modal
        createBtn.addEventListener("click", function () {
            createModal.style.display = "block";
            pagination.classList.add("hide-pagination");
        });

        // Open edit modal
        editBtns.forEach(button => {
            button.addEventListener("click", function () {
                selectedSubjectId = this.getAttribute("data-id");
                const subjectName = this.getAttribute("data-name");
                const classId = this.getAttribute("data-class-id");
                pagination.classList.add("hide-pagination");


                editNameInput.value = subjectName;
                // Set the correct class in the dropdown
                editClassSelect.value = classId;


                editModal.style.display = "block";
            });
        });

         // Send Update Request
        document.getElementById("saveChanges").addEventListener("click", function () {
            if (!selectedSubjectId) return;

            const updatedName = editNameInput.value;
            const updatedClassId = editClassSelect.value;


            fetch(`subject/update/${selectedSubjectId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ subject_name: updatedName, class_id: updatedClassId })
            }).then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("Error: " + JSON.stringify(data.error));
                } else {
                    alert(data.message);
                    editModal.style.display = "none"; // Close the modal
                    location.reload(); // Reload page to reflect changes
                }
            })
            .catch(error => console.error("Error:", error));
        });


        // Delete Class
        deleteBtns.forEach(button => {
            button.addEventListener("click", function () {
                const subjectId = this.getAttribute("data-id");

                if (!confirm("Are you sure you want to delete this class?")) return;

                fetch(`subject/delete/${subjectId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    }
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                }).catch(error => console.error("Error:", error));
            });
        });


        // Close modals
        closeCreateModal.addEventListener("click", function () {
            createModal.style.display = "none";
            pagination.classList.remove("hide-pagination");
        });

        closeEditModal.addEventListener("click", function () {
            editModal.style.display = "none";
            pagination.classList.remove("hide-pagination");
        });

        // Close modal when clicking outside
        window.addEventListener("click", function (event) {
            if (event.target === createModal) {
                createModal.style.display = "none";
                pagination.classList.remove("hide-pagination");

            }
            if (event.target === editModal) {
                editModal.style.display = "none";
                pagination.classList.remove("hide-pagination");

            }
        });
    });
</script>

