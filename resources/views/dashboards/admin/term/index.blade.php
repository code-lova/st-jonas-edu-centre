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
                <div class="fs-6 fw-bold text-red align-self-center "> Term Dashboard</div>
            </div>
            <h1>{{ $title }}</h1>
            @if ($noTermActive)
                <div class="alert alert-warning">
                    After creating a term, return to DASHBOARD to activate the current term.
                </div>
            @endif

            <!-- Create Class Button -->
            <button class="btn btn-secondary btn-sm fs-7 mt-4 mb-4" id="create">Create New term</button>


            <!-- Table detail -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Session</th>
                        <th>Term</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                    @forelse ( $term as $k=>$val )
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $val->session->name }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->start_date, date('Y/m/d') }}</td>
                            <td>{{ $val->end_date,  date('Y/m/d') }}</td>
                            <td>
                                <button disabled class="btn btn-secondary btn-sm fs-7 delete" data-id="{{ $val->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Term Not Yet Available</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Create session Modal -->
            <div id="createModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeCreateModal">&times;</span>
                    <h2>Create New Term</h2>
                    <form action="{{ route('create.term') }}" id="createForm" method="POST">
                        @csrf
                        <label class="pt-4" for="sessionName">Session:</label>
                        <select id="sessionName" name="session_id" class="form-select" required>
                            <option value="">Select a session</option>
                            @foreach ($sessions as $session)
                                <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>{{ $session->name }} Session</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="termName">Term Name:</label>
                        <select name="name" id="termName" class="form-select" required>
                            <option value="">Select Term</option>
                            <option value="First Term" {{ old('name') == 'First Term' ? 'selected' : '' }}>1st Term</option>
                            <option value="Second Term" {{ old('name') == 'Second Term' ? 'selected' : '' }}>2nd Term</option>
                            <option value="Third Term" {{ old('name') == 'Third Term' ? 'selected' : '' }}>3rd Term</option>
                        </select>
                        <br>
                        <label for="startDate"> Start Date:</label>
                        <input type="date" name="start_date" id="startDate" value="{{ old('start_date') }}" class="form-select" required>
                        <br>
                        <label for="endDate">End Date:</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" id="endDate" class="form-select" required>
                        <br>
                        <button type="submit" class="btn btn-secondary btn-sm fs-7" id="addClass">Add Term</button>
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

        // Get open modal buttons
        const createBtn = document.getElementById("create");
        const deleteBtn = document.querySelectorAll(".delete");

        // Get close buttons
        const closeCreateModal = document.getElementById("closeCreateModal");


        // Open create modal
        createBtn.addEventListener("click", function () {
            createModal.style.display = "block";
        });


        // Delete Class
        deleteBtn.forEach(button => {
            button.addEventListener("click", function () {
                const sessionId = this.getAttribute("data-id");

                if (!confirm("Are you sure you want to delete this data?")) return;

                fetch(`session/delete/${sessionId}`, {
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

        // Close modal when clicking outside
        window.addEventListener("click", function (event) {
            if (event.target === createModal) {
                createModal.style.display = "none";
            }
        });
    });
</script>

