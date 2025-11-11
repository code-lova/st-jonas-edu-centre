@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')
    <style>
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            border: none;
        }

        .form-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .section-header {
            background: linear-gradient(135deg, #6a0909 0%, #0056b3 100%);
            color: white;
            margin: -1rem -1rem 1rem -1rem;
            padding: 1rem;
            border-radius: 10px 10px 0 0;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            transform: translateY(-1px);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-input:disabled {
            background-color: #e9ecef;
            border-color: #ced4da;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .subject-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .subject-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .subject-card.disabled {
            background: #f8f9fa;
            opacity: 0.7;
        }

        .btn-create {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }

        .progress-indicator {
            background: #e9ecef;
            height: 4px;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #007bff, #0056b3);
            transition: width 0.3s ease;
        }

        .input-group-text {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #ced4da;
            border-radius: 8px 0 0 8px;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
            font-weight: bold;
        }

        .gender-selector {
            background: white;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 1rem;
        }

        .sticky-actions {
            position: sticky;
            bottom: 20px;
            z-index: 1000;
            background: white;
            border-radius: 12px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin-top: 2rem;
        }

        .subjects-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            background: #f8f9fa;
        }

        .subjects-container::-webkit-scrollbar {
            width: 8px;
        }

        .subjects-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .subjects-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .subjects-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .subjects-header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            padding: 0.5rem 0;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
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

            <!-- Header Card -->
            <div class="card mb-4 border-primary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">👨‍🏫 New Staff Registration</h5>
                    <small>Complete all required fields to register a new staff member</small>
                </div>
                <div class="card-body">
                    <!-- Progress Indicator -->
                    <div class="progress-indicator mb-3">
                        <div class="progress-bar" style="width: 0%" id="formProgress"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h6 class="text-primary">📝 Step 1: Personal Information</h6>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">🏫 Step 2: Teaching Assignment</h6>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">🔐 Step 3: Account Setup</h6>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data" id="staffForm">
                @csrf
                <!-- Personal Information Section -->
                <div class="card form-section mb-4">
                    <div class="card-body">
                        <div class="section-header">
                            <h6 class="mb-0">👤 Personal Information</h6>
                        </div>

                        <div class="row g-3">
                            <!-- Name Fields -->
                            <div class="col-md-4">
                                <label for="firstname" class="form-label required-field">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">👤</span>
                                    <input type="text" id="firstname" placeholder="Enter first name" name="firstname"
                                           value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" required />
                                </div>
                                @error('firstname')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="middlename" class="form-label">Middle Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">👤</span>
                                    <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}"
                                           placeholder="Enter middle name" class="form-control @error('middlename') is-invalid @enderror" />
                                </div>
                                @error('middlename')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="lastname" class="form-label required-field">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">👤</span>
                                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}"
                                           placeholder="Enter last name" class="form-control @error('lastname') is-invalid @enderror" required />
                                </div>
                                @error('lastname')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender and DOB -->
                            <div class="col-md-4">
                                <label class="form-label required-field">Gender</label>
                                <div class="gender-selector">
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sex" id="sex-male" value="Male"
                                                   {{ old('sex') == 'Male' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="sex-male">
                                                👨 Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sex" id="sex-female" value="Female"
                                                   {{ old('sex') == 'Female' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="sex-female">
                                                👩 Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="dateofbirth" class="form-label required-field">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text">📅</span>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" id="dateofbirth"
                                           class="form-control @error('date_of_birth') is-invalid @enderror" required />
                                </div>
                                @error('date_of_birth')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">📧</span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           placeholder="staff@example.com" class="form-control @error('email') is-invalid @enderror" />
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Section -->
                <div class="card form-section mb-4">
                    <div class="card-body">
                        <div class="section-header">
                            <h6 class="mb-0">📍 Additional Information</h6>
                        </div>

                        <div class="row g-3">
                            <!-- Location Details -->
                            <div class="col-12">
                                <label for="PlaceOfBirth" class="form-label">Place of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text">🌍</span>
                                    <input type="text" id="PlaceOfBirth" name="place_of_birth" value="{{ old('place_of_birth') }}"
                                           placeholder="Enter place of birth" class="form-control @error('place_of_birth') is-invalid @enderror" />
                                </div>
                                @error('place_of_birth')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Medical Information -->
                            <div class="col-md-4">
                                <label for="bloodgroup" class="form-label">Blood Group</label>
                                <div class="input-group">
                                    <span class="input-group-text">🩸</span>
                                    <select id="bloodgroup" name="blood_group" class="form-select @error('blood_group') is-invalid @enderror">
                                        <option value="">Select blood group</option>
                                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>
                                @error('blood_group')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="genotype" class="form-label">Genotype</label>
                                <div class="input-group">
                                    <span class="input-group-text">🧬</span>
                                    <select id="genotype" name="genotype" class="form-select @error('genotype') is-invalid @enderror">
                                        <option value="">Select genotype</option>
                                        <option value="AA" {{ old('genotype') == 'AA' ? 'selected' : '' }}>AA</option>
                                        <option value="AS" {{ old('genotype') == 'AS' ? 'selected' : '' }}>AS</option>
                                        <option value="AC" {{ old('genotype') == 'AC' ? 'selected' : '' }}>AC</option>
                                        <option value="SS" {{ old('genotype') == 'SS' ? 'selected' : '' }}>SS</option>
                                        <option value="SC" {{ old('genotype') == 'SC' ? 'selected' : '' }}>SC</option>
                                        <option value="CC" {{ old('genotype') == 'CC' ? 'selected' : '' }}>CC</option>
                                    </select>
                                </div>
                                @error('genotype')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="nationality" class="form-label required-field">Nationality</label>
                                <div class="input-group">
                                    <span class="input-group-text">🏳️</span>
                                    <input type="text" id="nationality" name="nationality" value="{{ old('nationality', 'Nigerian') }}"
                                           placeholder="Enter nationality" class="form-control @error('nationality') is-invalid @enderror" required />
                                </div>
                                @error('nationality')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="card form-section mb-4">
                    <div class="card-body">
                        <div class="section-header">
                            <h6 class="mb-0">📞 Contact Information</h6>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label required-field">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">📱</span>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="e.g., +234 803 123 4567" class="form-control @error('phone') is-invalid @enderror" required />
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="whatsApp_contact" class="form-label">WhatsApp Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">💬</span>
                                    <input type="tel" id="whatsApp_contact" name="whatsApp_contact" value="{{ old('whatsApp_contact') }}"
                                           placeholder="Same as mobile or different" class="form-control @error('whatsApp_contact') is-invalid @enderror" />
                                </div>
                                @error('whatsApp_contact')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="ResidentialAddress" class="form-label">Residential Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">🏠</span>
                                    <textarea id="ResidentialAddress" name="residential_address" rows="2"
                                              placeholder="Enter complete residential address"
                                              class="form-control @error('residential_address') is-invalid @enderror">{{ old('residential_address') }}</textarea>
                                </div>
                                @error('residential_address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="LocalGovernmentofOrigin" class="form-label">Local Government of Origin</label>
                                <div class="input-group">
                                    <span class="input-group-text">🏛️</span>
                                    <input type="text" id="LocalGovernmentofOrigin" name="local_govt_origin" value="{{ old('local_govt_origin') }}"
                                           placeholder="Enter LGA of origin" class="form-control @error('local_govt_origin') is-invalid @enderror" />
                                </div>
                                @error('local_govt_origin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Religion" class="form-label">Religion</label>
                                <div class="input-group">
                                    <span class="input-group-text">🙏</span>
                                    <select id="Religion" name="religion" class="form-select @error('religion') is-invalid @enderror">
                                        <option value="">Select religion</option>
                                        <option value="Christianity" {{ old('religion') == 'Christianity' ? 'selected' : '' }}>Christianity</option>
                                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Traditional" {{ old('religion') == 'Traditional' ? 'selected' : '' }}>Traditional</option>
                                        <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                @error('religion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teaching Assignment Section -->
                <div class="card form-section mb-4">
                    <div class="card-body">
                        <div class="section-header">
                            <h6 class="mb-0">🏫 Teaching Assignment</h6>
                        </div>

                        <!-- Class Teacher Assignment -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">👨‍🏫 Class Teacher Assignment</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="class_teacher_of" class="form-label">Assign as Class Teacher</label>
                                    <div class="input-group">
                                        <span class="input-group-text">🏫</span>
                                        <select id="class_teacher_of" class="form-select" name="class_teacher">
                                            <option value="">Not a class teacher</option>
                                            @foreach ( $classes as $val)
                                                <option value="{{ $val->id }}" {{ old('class_teacher') == $val->id ? 'selected' : '' }}>
                                                    {{ $val->class_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="text-muted">Optional: Select if this staff will be a class teacher</small>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Teaching Assignment -->
                        <div>
                            <h6 class="text-primary mb-3">📚 Subject Teaching Assignment</h6>
                            <p class="text-muted mb-3">Select the subjects this staff member will teach. Disabled subjects are already assigned to other teachers.</p>

                            @if(count($availableSubjects) > 0)
                                <div class="subjects-container">
                                    <div class="row g-3">
                                        @foreach ( $availableSubjects as $subject )
                                            @php
                                                $isAssigned = in_array($subject->id, $assignedSubjects);
                                                $isChecked = in_array($subject->id, old('subject_id', []));
                                            @endphp
                                            <div class="col-md-6 col-lg-4">
                                                <div class="subject-card p-3 {{ $isAssigned ? 'disabled' : '' }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="subject_id[]"
                                                               value="{{ $subject->id }}" id="subject_{{ $subject->id }}"
                                                               {{ $isAssigned ? 'disabled' : '' }}
                                                               {{ $isChecked ? 'checked' : '' }}>
                                                        <label class="form-check-label w-100" for="subject_{{ $subject->id }}">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <strong>{{ $subject->subject_name }}</strong>
                                                                    <small class="d-block text-muted">{{ $subject->class->class_name }}</small>
                                                                    @if($isAssigned)
                                                                        <small class="d-block text-danger">
                                                                            <i class="fas fa-lock"></i> Already assigned
                                                                        </small>
                                                                    @endif
                                                                </div>
                                                                <div class="text-end">
                                                                    @if($isAssigned)
                                                                        <span class="badge bg-secondary">Taken</span>
                                                                    @else
                                                                        <span class="badge bg-success">Available</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Subject Selection Summary -->
                                <div class="mt-3 p-2 bg-light rounded">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        <span id="selectedCount">0</span> subjects selected out of {{ count($availableSubjects) }} available
                                    </small>
                                </div>
                            @else
                                <div class="subjects-container">
                                    <div class="text-center py-4">
                                        <div class="text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-book mb-3" viewBox="0 0 16 16">
                                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                            </svg>
                                            <h5>No Available Subjects</h5>
                                            <p>All subjects are currently assigned to other teachers.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- Account Setup Section -->
                <div class="card form-section mb-4">
                    <div class="card-body">
                        <div class="section-header">
                            <h6 class="mb-0">🔐 Account Setup</h6>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="Username" class="form-label required-field">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">👤</span>
                                    <input type="text" id="Username" name="username" value="{{ old('username') }}"
                                           placeholder="Enter unique username" class="form-control @error('username') is-invalid @enderror" required/>
                                </div>
                                <small class="text-muted">Username will be used to log into the system</small>
                                @error('username')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Password" class="form-label required-field">Create Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">🔒</span>
                                    <input type="password" name="password" id="Password" placeholder="Enter strong password"
                                           class="form-control @error('password') is-invalid @enderror" required/>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Minimum 8 characters with letters and numbers</small>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label required-field">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">🔒</span>
                                    <input type="password" name="password_confirmation" id="confirmPassword"
                                           placeholder="Confirm password" class="form-control" required/>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Must match the password above</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sticky Actions -->
                <div class="sticky-actions">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('staff.list') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                        </div>
                        <div>
                            <button type="reset" class="btn btn-outline-warning me-2">
                                <i class="fas fa-undo"></i> Reset Form
                            </button>
                            <button type="submit" class="btn btn-create">
                                <i class="fas fa-user-plus"></i> Create Staff Member
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Form progress tracking
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('staffForm');
            const progressBar = document.getElementById('formProgress');
            const inputs = form.querySelectorAll('input[required], select[required]');

            function updateProgress() {
                let filledInputs = 0;
                inputs.forEach(input => {
                    if (input.type === 'radio') {
                        if (form.querySelector(`input[name="${input.name}"]:checked`)) {
                            filledInputs++;
                        }
                    } else if (input.value.trim() !== '') {
                        filledInputs++;
                    }
                });

                const progress = (filledInputs / inputs.length) * 100;
                progressBar.style.width = progress + '%';
            }

            inputs.forEach(input => {
                input.addEventListener('input', updateProgress);
                input.addEventListener('change', updateProgress);
            });

            // Subject selection counter
            function updateSubjectCount() {
                const selectedSubjects = document.querySelectorAll('input[name="subject_id[]"]:checked');
                const countElement = document.getElementById('selectedCount');
                if (countElement) {
                    countElement.textContent = selectedSubjects.length;
                }
            }

            // Add event listeners to subject checkboxes
            document.querySelectorAll('input[name="subject_id[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', updateSubjectCount);
            });

            // Initial subject count update
            updateSubjectCount();

            // Password visibility toggle
            document.getElementById('togglePassword').addEventListener('click', function() {
                const password = document.getElementById('Password');
                const icon = this.querySelector('i');

                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    password.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                const password = document.getElementById('confirmPassword');
                const icon = this.querySelector('i');

                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    password.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            // Form validation feedback
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('Password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    return false;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Staff...';
                submitBtn.disabled = true;
            });

            // Initial progress update
            updateProgress();
        });
    </script>



@endsection
