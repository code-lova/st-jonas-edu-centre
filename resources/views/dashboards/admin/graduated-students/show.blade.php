@extends('layouts.dashboard.admin.layout')

@section('content')
    <style>
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .profile-card {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 12px;
        }
        .info-label {
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        .info-value {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        .graduation-badge {
            background: linear-gradient(45deg, #ffd700, #ffed4a);
            color: #333;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
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
                <div class="fs-6 fw-bold text-red align-self-center">🎓 Graduated Student Details</div>
            </div>

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('graduated-students.index') }}" class="btn btn-outline-primary">
                    ← Back to Graduated Students
                </a>
            </div>

            <div class="row">
                <!-- Profile Card -->
                <div class="col-md-4 mb-4">
                    <div class="card profile-card">
                        <div class="card-body text-center">
                            @if($graduatedStudent->profile_pic)
                                <img src="{{ asset('uploads/' . $graduatedStudent->profile_pic) }}"
                                     alt="Profile Picture"
                                     class="rounded-circle mb-3"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                     style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif

                            <h4 class="fw-bold">{{ $graduatedStudent->full_name }}</h4>
                            <p class="mb-2">🎓 Graduate</p>
                            <span class="graduation-badge">
                                {{ $graduatedStudent->graduatedFromClass->class_name }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">📋 Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-label">First Name</div>
                                    <div class="info-value">{{ $graduatedStudent->firstname }}</div>

                                    <div class="info-label">Last Name</div>
                                    <div class="info-value">{{ $graduatedStudent->lastname }}</div>

                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">{{ $graduatedStudent->email }}</div>

                                    <div class="info-label">Gender</div>
                                    <div class="info-value">{{ $graduatedStudent->sex }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-label">Date of Birth</div>
                                    <div class="info-value">
                                        {{ $graduatedStudent->date_of_birth ? $graduatedStudent->date_of_birth->format('M j, Y') : 'Not provided' }}
                                    </div>

                                    <div class="info-label">Phone Number</div>
                                    <div class="info-value">{{ $graduatedStudent->phone_number ?? 'Not provided' }}</div>

                                    <div class="info-label">Address</div>
                                    <div class="info-value">{{ $graduatedStudent->address ?? 'Not provided' }}</div>

                                    <div class="info-label">Student ID</div>
                                    <div class="info-value">{{ $graduatedStudent->student_id }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Academic Information -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">🎓 Academic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-label">Graduated From Class</div>
                            <div class="info-value">
                                <span class="badge bg-success fs-6">
                                    {{ $graduatedStudent->graduatedFromClass->class_name }}
                                </span>
                            </div>

                            <div class="info-label">Academic Year</div>
                            <div class="info-value">{{ $graduatedStudent->academic_year }}</div>

                            <div class="info-label">Graduation Date</div>
                            <div class="info-value">{{ $graduatedStudent->graduation_date->format('F j, Y') }}</div>

                            <div class="info-label">Graduation Note</div>
                            <div class="info-value">{{ $graduatedStudent->graduation_note ?? 'No special note' }}</div>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">⚙️ System Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="info-label">Processed By</div>
                            <div class="info-value">
                                {{ $graduatedStudent->processedBy ? $graduatedStudent->processedBy->firstname . ' ' . $graduatedStudent->processedBy->lastname : 'System' }}
                            </div>

                            <div class="info-label">Batch ID</div>
                            <div class="info-value">
                                <code>{{ $graduatedStudent->batch_id ?? 'N/A' }}</code>
                            </div>

                            <div class="info-label">Record Created</div>
                            <div class="info-value">{{ $graduatedStudent->created_at->format('F j, Y g:i A') }}</div>

                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ $graduatedStudent->updated_at->format('F j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="fw-bold mb-3">Quick Actions</h6>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('graduated-students.index') }}" class="btn btn-primary">
                                    📋 View All Graduates
                                </a>
                                <a href="{{ route('graduated-students.export', ['search' => $graduatedStudent->full_name]) }}"
                                   class="btn btn-success">
                                    📊 Export This Student
                                </a>
                                <button type="button" class="btn btn-info" onclick="window.print()">
                                    🖨️ Print Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style media="print">
        .btn, .card-header, .sticky-top {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    </style>
@endsection
