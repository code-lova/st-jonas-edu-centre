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
                <div class="fs-6 fw-bold text-red align-self-center "> Session Dashboard</div>
            </div>
            <h1>{{ $title }}</h1>

            <!-- Create Class Button -->
            <button class="btn btn-secondary btn-sm fs-7 mt-4 mb-4" id="create">Create Session</button>


            <!-- Table detail -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sessions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                    @forelse ( $sessions as $k=>$session )
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $session->name }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm fs-7 delete" data-id="{{ $session->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Sessions Not Yet Available</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Create session Modal -->
            <div id="createModal" class="class-modal">
                <div class="modal-content">
                    <span class="close" id="closeCreateModal">&times;</span>
                    <h2>Create New Session</h2>
                    <form action="{{ route('create.session') }}" id="createForm" method="POST">
                        @csrf
                        <label for="session" class="pb-4 pt-2">Select Academic Session:</label>
                        <select name="name" id="session" class="form-select" required>
                            <option value="">Select Session</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2025/2026">2025/2026</option>
                            <option value="2026/2027">2026/2027</option>
                            <option value="2027/2028">2027/2028</option>
                            <option value="2028/2029">2028/2029</option>
                            <option value="2029/2030">2029/2030</option>
                            <option value="2030/2031">2030/2031</option>
                            <option value="2031/2032">2031/2032</option>
                            <option value="2032/2033">2032/2033</option>
                            <option value="2033/2034">2033/2034</option>
                            <option value="2034/2035">2034/2035</option>
                            <option value="2035/2036">2035/2036</option>
                            <option value="2036/2037">2036/2037</option>
                            <option value="2037/2038">2037/2038</option>
                            <option value="2038/2039">2038/2039</option>
                            <option value="2039/2040">2039/2040</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-secondary btn-sm fs-7" id="addClass">Add Session</button>
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

