@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')
    <style>

        select {
            border: 1px solid #15151558;
        }
        option{
            padding: .2rem;
            color: #151515c1;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #650018;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .form-check-input:checked {
            background-color: #650018;
            border-color: #650018;
        }

        .form-check-input:disabled {
            background-color: #ccc;
            border-color: #999;
            cursor: not-allowed;
            box-shadow: none;
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
            <div class="bg-light px-3 rounded text-red">
                <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row pb-2">
                        <!-- first name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="firstname" class="text-capitalize fs-9 form-label">Firstname</label>
                            <input type="text" id="firstname" placeholder="First Name" name="firstname" value="{{ old('firstname') }}"
                                class="form-control form-control-sm @error('firstname') is-invalid @enderror" required />
                            @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- middle name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="middlename" class="text-capitalize fs-9 form-label">Middle Name</label>
                            <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}" placeholder="Middle Name"
                                class="form-control form-control-sm @error('middlename') is-invalid @enderror" />
                            @error('middlename')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- last name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="lastname" class="text-capitalize fs-9 form-label">Last Name</label>
                            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name"
                                class="form-control form-control-sm @error('lastname') is-invalid @enderror" required />
                            @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- gender  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <div class="fs-7 pe-5" >Sex</div>
                            <div class="d-flex gap-5 py-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex-male" value="Male"
                                    {{ old('sex') == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label fs-9" for="sex-male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex-female" value="Female"
                                    {{ old('sex') == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label fs-9" for="sex-female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- date of birth  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="dateofbirth" class="text-capitalize fs-9 form-label">Date of
                                birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" id="dateofbirth"
                                class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror" required />
                            @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                         <!-- email  -->
                         <div class="my-1 col-12 col-md-4 text-start">
                            <label for="email" class="text-capitalize fs-9 form-label">Email</label>
                            <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="email address"
                                class="form-control form-control-sm @error('email') is-invalid @enderror" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- place of birth  -->
                        <div class="my-1 col-12 text-start">
                            <label for="PlaceOfBirth" class="text-capitalize fs-9 form-label">Place Of
                                Birth</label>
                            <input type="text" id="PlaceOfBirth" name="place_of_birth" value="{{ old('place_of_birth') }}" placeholder="Place Of Birth"
                                class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror" />
                            @error('place_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- blood group  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="bloodgroup" class="text-capitalize fs-9 form-label">Blood
                                Group</label>
                            <input type="text" id="bloodgroup" name="blood_group" value="{{ old('blood_group') }}" placeholder="Blood Group"
                                class="form-control form-control-sm @error('blood_group') is-invalid @enderror" />
                            @error('blood_group')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- genotype  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="genotype" class="text-capitalize fs-9 form-label">Genotype</label>
                            <input type="text" id="genotype" placeholder="Genotype" value="{{ old('genotype') }}" name="genotype"
                                class="form-control form-control-sm @error('genotype') is-invalid @enderror"/>
                            @error('genotype')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                         <!-- Phone contact  -->
                         <div class="my-1 col-12 col-md-4 text-start">
                            <label for="phone" class="text-capitalize fs-9 form-label">Mobile Contact (Required)</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter mobile number"
                                class="form-control form-control-sm @error('phone') is-invalid @enderror" required />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                         <!-- WhatsApp contact  -->
                         <div class="my-1 col-12 col-md-4 text-start">
                            <label for="whatsApp_contact" class="text-capitalize fs-9 form-label">WhatsApp (Optional)</label>
                            <input type="text" id="whatsApp_contact" name="whatsApp_contact" value="{{ old('whatsApp_contact') }}" placeholder="Enter mobile number"
                                class="form-control form-control-sm @error('whatsApp_contact') is-invalid @enderror" />
                            @error('whatsApp_contact')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="my-1 col-12 col-md-4 text-start"></div>
                        <!-- Residential address  -->
                        <div class="my-1 col-12 text-start">
                            <label for="ResidentialAddress" class="text-capitalize fs-9 form-label">Residential
                                Address</label>
                            <input type="text" id="ResidentialAddress" name="residential_address"  value="{{ old('residential_address') }}" placeholder="Residential Address"
                                class="form-control form-control-sm @error('residential_address') is-invalid @enderror" />
                            @error('residential_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- local government of origin  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="LocalGovernmentofOrigin" class="text-capitalize fs-9 form-label">Local
                                Government of Origin</label>
                            <input type="text" id="LocalGovernmentofOrigin" name="local_govt_origin"  value="{{ old('local_govt_origin') }}"
                                placeholder="Local Government of Origin" class="form-control form-control-sm @error('local_govt_origin') is-invalid @enderror" />
                            @error('local_govt_origin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- religion  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="Religion" class="text-capitalize fs-9 form-label">Religion</label>
                            <input type="text" id="Religion" name="religion"  value="{{ old('religion') }}" placeholder="Religion"
                                class="form-control form-control-sm @error('religion') is-invalid @enderror" />
                                @error('religion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Nationality -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="Nationality" class="text-capitalize fs-9 form-label">Nationality</label>
                            <input type="text" id="Nationality" name="nationality"  value="{{ old('nationality') }}" placeholder="Nationality"
                                class="form-control form-control-sm @error('nationality') is-invalid @enderror" required/>
                            @error('nationality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Form Teacher or Not -->
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue fs-7 col-4 col-md-4"><label for="class_teacher_of" class="px-2">Class Teacher:</label></div>
                                    <div class="col-8 fs-7 col-md-4">
                                        <select id="class_teacher_of" class="form-select form-select-sm" name="class_teacher">
                                            <option value="">Not a class teacher</option>
                                            @foreach ( $classes as $val)
                                                <option value="{{ $val->id }}">{{ $val->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- Subjects to Teach -->
                        <div class="my-4">
                            <h3 class="fw-bold fs-6 pt-4">Select Subjects to Teach</h3>
                            <small>Disabled subjects means they are already assigned to a teacher</small>
                            <!--A Checked List of class and subject -->
                            <div class="row row-cols-1 row-cols-md-4 g-3">
                                @forelse ( $availableSubjects as $subject )
                                @php
                                    // Check if subject is already assigned to a teacher
                                    $isAssigned = in_array($subject->id, $assignedSubjects);
                                    $isChecked = in_array($subject->id, old('subject_id', []));
                                @endphp
                                <div class="col">
                                    <div class="p-2 bg-light rounded">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="subject_id[]" value="{{ $subject->id }}"
                                                {{ $isAssigned ? 'disabled' : '' }}
                                                {{ $isChecked ? 'checked' : '' }}>
                                            <label class="form-check-label text-start" for="subject_id">
                                                {{ $subject->subject_name }}
                                                <small class="d-block text-muted">({{ $subject->class->class_name }})</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div style="margin: 0 auto; margin-top: 20px;">
                                        <h3 class="fw-bold fs-6 pt-4">There are no available subjects for now</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>


                        <h3 class="fw-bold fs-6 pt-4">Create Username & Password</h3>
                        <div class="my-1 col-12 text-start">
                            <label for="Username" class="text-capitalize fs-9 form-label">Username</label>
                            <input type="text" id="Username" name="username"  value="{{ old('username') }}" placeholder="Enter Username"
                                class="form-control form-control-sm @error('username') is-invalid @enderror" required/>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Password" class="text-capitalize fs-9 form-label">Create
                                Password</label>
                            <input type="password" name="password" id="Password" placeholder="Enter Password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror" required/>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="confirmPassword" class="text-capitalize fs-9 form-label">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password"
                                class="form-control form-control-sm" required/>
                        </div>

                        <button type="submit" class="btn my-4 btn-secondary text-capitalize">Create new staff</button>
                    </div>
                </form>
            </div>
        </div>
    </section>



@endsection
