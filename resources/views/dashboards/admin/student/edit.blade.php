@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


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
                <div class="fs-6 fw-bold text-red align-self-center ">{{ $title }}</div>
            </div>
            <div class="d-grid gap-4">
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item">
                        @if ($user->passport == Null)
                            <img width="100" height="100" style="border-radius: 5px" src="{{ asset('assets/images/avatar.png') }}" alt="{{ $user->firstname }}">
                        @else
                            <img width="230" height="200" style="border-radius: 5px" src="{{ asset('uploads/'.$user->passport) }}" alt="{{ $user->firstname }}">
                        @endif
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue text-blue fs-7 col-4 col-md-4"><span class="px-2">Name:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span class="text-capitalize text-blue" id="FullName">{{ $user->firstname }} {{ $user->middlename ?? 'N/A' }}  {{ $user->lastname }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Gender:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="Gender" class="text-lowercase text-blue">{{ $user->sex }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Date of Birth:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="DateOfBirth" class="text-capitalize text-blue"> {{$user->date_of_birth, date("Y/m/d",)}}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Place Of Birth:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="PlaceOfBirth" class="text-capitalize text-blue">{{ $user->place_of_birth }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Genotype:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="Genotype" class="text-capitalize text-blue">{{ $user->genotype }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Blood Group:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="bloodgroup" class="text-capitalize text-blue">{{ $user->blood_group }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Residential Address:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="ResidentialAddress" class="text-capitalize text-blue">{{ $user->residential_address }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">LGA Origin:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="LGAOrigin" class="text-capitalize text-blue">{{ $user->local_govt_origin }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Religion:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="Religion" class="text-capitalize text-blue">{{ $user->religion }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Nationality:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="bloodgroup" class="text-capitalize text-blue">{{ $user->nationality }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Previous School:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="previousSchool" class="text-capitalize text-blue">{{ $user->previous_school ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Last Class Passed:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="lastclasspassed" class="text-capitalize text-blue">
                                    {{ $user->lastClassPassed ? $user->lastClassPassed->class_name : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Current Class:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="previousSchool" class="text-capitalize text-blue">
                                    {{ $user->currentClassApplying ? $user->currentClassApplying->class_name : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Abnormalities:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="Abnormalities" class="text-capitalize text-blue">
                                    {{ $user->healthInfo && $user->healthInfo->abnormal_behaviour ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Health Comment:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="HealthComment" class="text-capitalize text-blue">
                                    {{ $user->healthInfo ? $user->healthInfo->description ?? 'N/A' : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Health Condition:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="HealthCondition" class="text-capitalize text-blue">
                                    {{ $user->healthInfo ? $user->healthInfo->child_general_health_condition ?? 'N/A' : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Parents Phone:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <a href="tel:{{ $user->parentInfo ? $user->parentInfo->fathers_phone : 'N/A' }}" class="text-lowercase text-blue"
                                    id="ParentsPhone">{{ $user->parentInfo ? $user->parentInfo->fathers_phone : 'N/A' }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Parents Address:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="ParentsAddress" class="text-capitalize text-blue">
                                    {{ $user->parentInfo ? $user->parentInfo->parent_address : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Parents Occupation:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="ParentsOccupation" class="text-capitalize text-blue">
                                    {{ $user->parentInfo ? ($user->parentInfo->occupation ?? 'N/A') : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Email:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <a href="mailto:{{ $user->email ?? 'N/A' }}" class="text-capitalize text-blue "
                                    id="Email"><span>{{ $user->email ?? 'N/A' }}</span></a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Fathers Phone:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <a href="tel:{{ $user->parentInfo ? $user->parentInfo->fathers_phone : 'N/A' }}" class="text-capitalize text-blue"
                                    id="FathersPhone">{{ $user->parentInfo ? $user->parentInfo->fathers_phone : 'N/A' }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Mothers Phone:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <a href="tel:{{ $user->parentInfo ? ($user->parentInfo->mothers_phone ?? 'N/A') : 'N/A' }}" class="text-capitalize text-blue"
                                    id="MothersPhone">{{ $user->parentInfo ? ($user->parentInfo->mothers_phone ?? 'N/A') : 'N/A' }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="text-blue fs-7 col-4 col-md-4">
                                <span class="px-2">Students Username:</span>
                            </div>
                            <div class="col-8 fs-7 col-md-8">
                                <span id="StudentsPassword" class="text-capitalize text-blue">{{ $user->username }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
                <a href="{{ url('/admin/update-student/'. $user->id) }}" class="btn my-4 btn-secondary text-capitalize">Edit/Update Student</a>
            </div>
        </div>
    </section>


@endsection
