@extends('layouts.dashboard.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <section class="main p-0 col-12  text-blue col-md-9  text-center">
        <div class="main-body overflow-auto vh-100">
            <div class="d-flex justify-content-md-center py-2 sticky-top greyish">
                <div class="d-md-none px-3" data-bs-toggle="offcanvas" href="#mobileMenu" role="button" aria-controls="mobileMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <div class="fs-6 fw-bold text-blue align-self-center ">{{ $title }}</div>
            </div>
            @if ($currentTermSession && $currentTermSession->session)
                <div class="bg-light text-start px-3 py-2">
                    <div class="fs-6 fw-semibold">CURRENT - SESSION: {{ $currentTermSession->session->name }}, CURRENT - TERM: {{ $currentTermSession->name }}</div>
                </div>
            @else
                <div class="alert alert-warning">
                    No active term or session is currently set. Please ensure at least one term is created and activated by admin.
                </div>
            @endif
            <div class="bg-light px-3 rounded text-blue">
                <div class="info">
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold text-capitalize">Your Personal Info</div>
                        <div class="fs-7">To make changes to personal info please contact school Admin.</div>
                    </div>
                    <div class="d-grid gap-4">
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue text-blue fs-7 col-4 col-md-2"><span class="px-2">Name:</span></div>
                                    <div class="col-8 fs-7 col-md-10">
                                        @if ($profile->sex == 'Male')
                                            <span class="pe-1 text-blue" id="Title">Mr.</span>
                                        @elseif ($profile->sex == 'Female')
                                            <span class="pe-1 text-blue" id="Title">Mrs.</span>
                                        @endif
                                        <span class="text-capitalize text-blue" id="FullName">
                                            {{ $profile->firstname }}
                                            @if (!empty($profile->middlename))
                                                {{ $profile->middlename }}
                                            @endif
                                            {{ $profile->lastname }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue fs-7 col-4 col-md-2">
                                        <span class="px-2">Gender:</span>
                                    </div>
                                    <div class="col-8 fs-7 col-md-10">
                                        <span id="Gender" class="text-lowercase text-blue">{{ $profile->sex }}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue fs-7 col-4 col-md-2">
                                        <span class="px-2">Email:</span>
                                    </div>
                                    <div class="col-8 fs-7 col-md-10">
                                        <a href="#" class="text-lowercase text-blue "
                                        id="Email"><span>{{ $profile->email ?? 'N/A' }}</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue fs-7 col-4 col-md-2">
                                        <span class="px-2">Phone:</span>
                                    </div>
                                    <div class="col-8 fs-7 col-md-10">
                                        <a href="tel:+2348165179215" class="text-lowercase text-blue" id="Phone">{{ $profile->phone ?? 'N/A' }}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="text-blue fs-7 col-4 col-md-2">
                                        <span class="px-2">Address</span>
                                    </div>
                                    <div class="col-8 fs-7 col-md-10">
                                        <span id="Address" class="text-capitalize text-blue">
                                            {{ $profile->residential_address }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="password text-blue pt-3">
                    <div class="text-start px-2 py-5">
                        <div class="fs-6 fw-semibold text-capitalize">Change Your Password</div>
                        <div class="fs-7 text-blue">You can change your password here</div>
                    </div>
                    <form action="{{ route('profile.change_password') }}" method="POST">
                        @csrf
                        <div class="row pb-5">
                            <div class="my-1 col-12 col-md-6 text-start">
                                <label for="oldPassword" class="text-capitalize fs-9 form-label">Old Password</label>
                                <input type="password" id="oldPassword" name="old_password" placeholder="Enter Old Password"
                                    class="form-control form-control-sm" required />
                                @error('old_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="my-1 col-12 col-md-6 text-start">
                                <label for="newPassword" class="text-capitalize fs-9 form-label">New Password</label>
                                <input type="password" id="newPassword" name="new_password" placeholder="Enter New Password"
                                    class="form-control form-control-sm" required />
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="my-1 col-12 text-start">
                                <label for="confirmPassword" class="text-capitalize fs-9 form-label">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Re-Enter New Password"
                                    class="form-control form-control-sm" required />
                                @error('confirm_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn my-4 btn-secondary text-capitalize">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
