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
            background: linear-gradient(135deg, #5c1409 0%, #0056b3 100%);
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

        .health-selector {
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

        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            padding: 0.6rem 0.75rem;
            background: white;
            border: 1px solid #ced4da;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: #f8f9fa;
            border-color: #86b7fe;
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
                <h5 class="mb-0">🎓 New Student Registration</h5>
                <small>Complete all required fields to register a new student</small>
            </div>
            <div class="card-body">
                <!-- Progress Indicator -->
                <div class="progress-indicator mb-3">
                    <div class="progress-bar" style="width: 0%" id="formProgress"></div>
                </div>
                <div class="row text-center">
                    <div class="col-md-3">
                        <h6 class="text-primary">👤 Step 1: Personal Info</h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-muted">🏥 Step 2: Health Info</h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-muted">👨‍👩‍👧‍👦 Step 3: Parent Info</h6>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-muted">🔐 Step 4: Account Setup</h6>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" id="studentForm">
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

                        <!-- Gender, DOB, and Photo -->
                        <div class="col-md-4">
                            <label class="form-label required-field">Gender</label>
                            <div class="gender-selector">
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="sex-male" value="Male"
                                               {{ old('sex') == 'Male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sex-male">
                                            👦 Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="sex-female" value="Female"
                                               {{ old('sex') == 'Female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sex-female">
                                            👧 Female
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
                            <label for="passport" class="form-label">Student Photo</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="passport" name="passport" class="file-upload-input @error('passport') is-invalid @enderror"
                                       accept="image/*" />
                                <label for="passport" class="file-upload-label">
                                    <span class="input-group-text" style="border: none; background: none;">📷</span>
                                    <span id="fileName">Choose student photo...</span>
                                </label>
                            </div>
                            <small class="text-muted">Optional: Upload student's photo (jpg, png)</small>
                            @error('passport')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Health Information Section -->
            <div class="card form-section mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <h6 class="mb-0">🏥 Health Information</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="PlaceOfBirth" class="form-label">Place of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text">📍</span>
                                <input type="text" id="PlaceOfBirth" name="place_of_birth" value="{{ old('place_of_birth') }}"
                                       placeholder="Enter birthplace" class="form-control @error('place_of_birth') is-invalid @enderror" />
                            </div>
                            @error('place_of_birth')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="bloodgroup" class="form-label">Blood Group</label>
                            <div class="input-group">
                                <span class="input-group-text">🩸</span>
                                <input type="text" id="bloodgroup" name="blood_group" value="{{ old('blood_group') }}"
                                       placeholder="e.g. O+" class="form-control @error('blood_group') is-invalid @enderror" />
                            </div>
                            @error('blood_group')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="genotype" class="form-label">Genotype</label>
                            <div class="input-group">
                                <span class="input-group-text">🧬</span>
                                <input type="text" id="genotype" placeholder="e.g. AA" value="{{ old('genotype') }}" name="genotype"
                                       class="form-control @error('genotype') is-invalid @enderror"/>
                            </div>
                            @error('genotype')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Details Section -->
            <div class="card form-section mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <h6 class="mb-0">📋 Personal Details</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="ResidentialAddress" class="form-label">Residential Address</label>
                            <div class="input-group">
                                <span class="input-group-text">🏠</span>
                                <input type="text" id="ResidentialAddress" name="residential_address" value="{{ old('residential_address') }}"
                                       placeholder="Enter full residential address" class="form-control @error('residential_address') is-invalid @enderror" />
                            </div>
                            @error('residential_address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="LocalGovernmentofOrigin" class="form-label">Local Government of Origin</label>
                            <div class="input-group">
                                <span class="input-group-text">🏛️</span>
                                <input type="text" id="LocalGovernmentofOrigin" name="local_govt_origin" value="{{ old('local_govt_origin') }}"
                                       placeholder="Enter LGA" class="form-control @error('local_govt_origin') is-invalid @enderror" />
                            </div>
                            @error('local_govt_origin')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="Religion" class="form-label">Religion</label>
                            <div class="input-group">
                                <span class="input-group-text">⛪</span>
                                <input type="text" id="Religion" name="religion" value="{{ old('religion') }}"
                                       placeholder="Enter religion" class="form-control @error('religion') is-invalid @enderror" />
                            </div>
                            @error('religion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="Nationality" class="form-label required-field">Nationality</label>
                            <div class="input-group">
                                <span class="input-group-text">🌍</span>
                                <input type="text" id="Nationality" name="nationality" value="{{ old('nationality') }}"
                                       placeholder="Enter nationality" class="form-control @error('nationality') is-invalid @enderror" required/>
                            </div>
                            @error('nationality')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="previousSchool" class="form-label">Previous School Attended</label>
                            <div class="input-group">
                                <span class="input-group-text">🏫</span>
                                <input type="text" id="previousSchool" name="previous_school" value="{{ old('previous_school') }}"
                                       placeholder="Enter previous school name (or N/A if none)" class="form-control @error('previous_school') is-invalid @enderror"/>
                            </div>
                            @error('previous_school')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="LastClassPassed" class="form-label required-field">Last Class Passed</label>
                            <div class="input-group">
                                <span class="input-group-text">📚</span>
                                <select name="last_class_passed" id="LastClassPassed" class="form-select @error('last_class_passed') is-invalid @enderror" required="">
                                    <option value="">Select previous class</option>
                                    @foreach ( $classes as $val)
                                        <option value="{{ $val->id }}" {{ old('last_class_passed') == $val->id ? 'selected' : '' }}>{{ $val->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                             @error('last_class_passed')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="ClassCurrentlyApplyingFor" class="form-label required-field">Class Currently Applying For</label>
                            <div class="input-group">
                                <span class="input-group-text">🎯</span>
                                <select name="current_class_applying" id="ClassCurrentlyApplyingFor" class="form-select @error('current_class_applying') is-invalid @enderror" required="">
                                    <option value="">Select the class to apply for</option>
                                    @foreach ( $classes as $val)
                                        <option value="{{ $val->id }}" {{ old('current_class_applying') == $val->id ? 'selected' : '' }}>{{ $val->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('current_class_applying')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Student Health & Behavior Section -->
            <div class="card form-section mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <h6 class="mb-0">🧠 Behavioral & Health Assessment</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Does your ward behave abnormally at times?</label>
                            <div class="behavioral-selector">
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="abnormal_behaviour" id="yesabnormal" value="Yes"
                                               {{ old('abnormal_behaviour') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="yesabnormal">
                                            ⚠️ Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="abnormal_behaviour" id="noabnormal" value="No"
                                               {{ old('abnormal_behaviour') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="noabnormal">
                                            ✅ No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="AbnormalExplanation" class="form-label">If yes, please explain in detail</label>
                            <textarea id="AbnormalExplanation" name="description" value="{{ old('description') }}"
                                      placeholder="Please describe the behavioral issues..." rows="3"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="HealthCondition" class="form-label">What is your child's general health condition?</label>
                            <div class="input-group">
                                <span class="input-group-text">💊</span>
                                <input type="text" id="HealthCondition" name="child_general_health_condition" value="{{ old('child_general_health_condition') }}"
                                       placeholder="Describe overall health status" class="form-control @error('child_general_health_condition') is-invalid @enderror" />
                            </div>
                            @error('child_general_health_condition')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Parent Information Section -->
            <div class="card form-section mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <h6 class="mb-0">👨‍👩‍👧‍👦 Parent Information</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ParentsName" class="form-label">Parent/Guardian Name</label>
                            <div class="input-group">
                                <span class="input-group-text">👤</span>
                                <input type="text" id="ParentsName" name="parent_name" value="{{ old('parent_name') }}"
                                       placeholder="Enter parent/guardian name" class="form-control @error('parent_name') is-invalid @enderror" />
                            </div>
                            @error('parent_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Occupation" class="form-label">Occupation</label>
                            <div class="input-group">
                                <span class="input-group-text">💼</span>
                                <input type="text" id="Occupation" name="occupation" value="{{ old('occupation') }}"
                                       placeholder="Enter occupation" class="form-control @error('occupation') is-invalid @enderror" />
                            </div>
                            @error('occupation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="ParentsAddress" class="form-label">Parent/Guardian Address</label>
                            <div class="input-group">
                                <span class="input-group-text">🏠</span>
                                <input type="text" id="ParentsAddress" name="parent_address" value="{{ old('parent_address') }}"
                                       placeholder="Enter parent/guardian address" class="form-control @error('parent_address') is-invalid @enderror" />
                            </div>
                            @error('parent_address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Fathersphone" class="form-label">Father's Phone</label>
                            <div class="input-group">
                                <span class="input-group-text">📞</span>
                                <input type="tel" id="Fathersphone" name="fathers_phone" value="{{ old('fathers_phone') }}"
                                       placeholder="Enter father's phone number" class="form-control @error('fathers_phone') is-invalid @enderror" />
                            </div>
                            @error('fathers_phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Mothersphone" class="form-label">Mother's Phone</label>
                            <div class="input-group">
                                <span class="input-group-text">📞</span>
                                <input type="tel" id="Mothersphone" name="mothers_phone" value="{{ old('mothers_phone') }}"
                                       placeholder="Enter mother's phone number" class="form-control @error('mothers_phone') is-invalid @enderror" />
                            </div>
                            @error('mothers_phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Setup Section -->
            <div class="card form-section mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <h6 class="mb-0">🔐 Account Setup</h6>
                        <small class="text-muted">Create login credentials for the student</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="Username" class="form-label required-field">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">👤</span>
                                <input type="text" id="Username" name="username" value="{{ old('username') }}"
                                       placeholder="Enter unique username" class="form-control @error('username') is-invalid @enderror" required/>
                            </div>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Choose a unique username for student login</small>
                        </div>

                        <div class="col-md-6">
                            <label for="Password" class="form-label required-field">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">🔒</span>
                                <input type="password" name="password" id="Password" placeholder="Create secure password"
                                       class="form-control @error('password') is-invalid @enderror" required/>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Password should be at least 6 characters long</small>
                        </div>

                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label required-field">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text">🔒</span>
                                <input type="password" name="password_confirmation" id="confirmPassword"
                                       placeholder="Confirm password" class="form-control" required/>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Re-enter the password to confirm</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="sticky-bottom bg-white p-3 border-top">
                <div class="d-flex gap-3 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                        <i class="bi bi-arrow-left"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                        <span class="btn-text">
                            <i class="bi bi-plus-circle"></i> Register Student
                        </span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordField = document.getElementById('Password');
    const confirmPasswordField = document.getElementById('confirmPassword');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }

    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    }

    // File upload display
    const fileInput = document.getElementById('passport');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Choose student photo...';
            const fileNameSpan = document.getElementById('fileName');
            if (fileNameSpan) {
                fileNameSpan.textContent = fileName;
            }
        });
    }

    // Form progress tracking
    const form = document.getElementById('studentForm');
    const progressBar = document.getElementById('formProgress');
    const requiredFields = form.querySelectorAll('input[required], select[required]');

    function updateProgress() {
        let filledFields = 0;
        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = form.querySelectorAll(`input[name="${field.name}"]:checked`);
                if (radioGroup.length > 0) filledFields++;
            } else if (field.value.trim() !== '') {
                filledFields++;
            }
        });

        const progress = (filledFields / requiredFields.length) * 100;
        progressBar.style.width = progress + '%';

        // Update step indicators
        const steps = document.querySelectorAll('.col-md-3 h6');
        const currentStep = Math.ceil((progress / 100) * 4);
        steps.forEach((step, index) => {
            if (index < currentStep) {
                step.classList.remove('text-muted');
                step.classList.add('text-primary');
            } else {
                step.classList.remove('text-primary');
                step.classList.add('text-muted');
            }
        });
    }

    // Add event listeners to track progress
    requiredFields.forEach(field => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });

    // Initial progress update
    updateProgress();

    // Form submission handling
    const submitBtn = document.getElementById('submitBtn');
    form.addEventListener('submit', function() {
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');

        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
        submitBtn.disabled = true;
    });

    // Smooth scrolling for validation errors
    const firstError = document.querySelector('.is-invalid');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>

@endsection
