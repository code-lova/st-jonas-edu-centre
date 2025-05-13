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

        .modal-content label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
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

        .modal-content input:focus {
            border-color: #650018;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
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
                <div class="fs-6 fw-bold text-red align-self-center "> Class Dashboard</div>
            </div>
            <h1>Class List</h1>

            <!-- Create Class Button -->
            <button class="btn btn-secondary btn-sm fs-7 mt-4 mb-4" id="create-class">Create Class</button>


            <!-- Table detail -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                    @forelse ( $classes as $k=>$class )
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm fs-7 edit-class" data-id="{{ $class->id }}" data-name="{{ $class->class_name }}">Edit</button>
                                <button class="btn btn-secondary btn-sm fs-7 delete-class" data-id="{{ $class->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Class Records Available</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Create Class Modal -->
            <div id="createModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeCreateModal">&times;</span>
                    <h2>Create Class</h2>
                    <form action="{{ route('create.class') }}" id="createClassForm" method="POST">
                        @csrf
                        <label for="className">Class Name:</label>
                        <input type="text" value="{{ old('class_name') }}" id="className" name="class_name" required><br><br>
                        <button type="submit" class="btn btn-secondary btn-sm fs-7" id="addClass">Add Class</button>
                    </form>
                </div>
            </div>

            <!-- Edit Class Modal -->
            <div id="editModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeEditModal">&times;</span>
                    <h2>Edit Class</h2>
                    <form id="editClassForm">
                        <label for="editClassName">Class Name:</label>
                        <input type="text" id="editClassName" name="editClassName" required><br><br>
                        <button type="button" class="btn btn-secondary btn-sm fs-7" id="saveClassChanges">Save Changes</button>
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
        const createClassBtn = document.getElementById("create-class");
        const editClassBtns = document.querySelectorAll(".edit-class");
        const deleteClassBtns = document.querySelectorAll(".delete-class");

        // Get close buttons
        const closeCreateModal = document.getElementById("closeCreateModal");
        const closeEditModal = document.getElementById("closeEditModal");

        // Input fields in the modals
        const editClassNameInput = document.getElementById("editClassName");
        let selectedClassId = null; // Store selected class ID


        // Open create modal
        createClassBtn.addEventListener("click", function () {
            createModal.style.display = "block";
        });

        // Open edit modal
        editClassBtns.forEach(button => {
            button.addEventListener("click", function () {
                selectedClassId = this.getAttribute("data-id");
                const className = this.getAttribute("data-name");

                editClassNameInput.value = className;
                editModal.style.display = "block";
            });
        });

         // Send Update Request
        document.getElementById("saveClassChanges").addEventListener("click", function () {
            if (!selectedClassId) return;

            const updatedName = editClassNameInput.value;

            fetch(`class/update/${selectedClassId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ class_name: updatedName })
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
        deleteClassBtns.forEach(button => {
            button.addEventListener("click", function () {
                const classId = this.getAttribute("data-id");

                if (!confirm("Are you sure you want to delete this class?")) return;

                fetch(`class/delete/${classId}`, {
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
        });

        closeEditModal.addEventListener("click", function () {
            editModal.style.display = "none";
        });

        // Close modal when clicking outside
        window.addEventListener("click", function (event) {
            if (event.target === createModal) {
                createModal.style.display = "none";
            }
            if (event.target === editModal) {
                editModal.style.display = "none";
            }
        });
    });
</script>

