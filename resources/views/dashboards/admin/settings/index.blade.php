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
                <div class="fs-6 fw-bold text-red align-self-center ">{{ $title }}</div>
            </div>
            <div class="bg-light px-3 rounded text-red">
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row pb-2">
                        <!-- App name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="firstname" class="text-capitalize fs-9 form-label">Application Name</label>
                            <input type="text" id="site_name" name="site_name"  value="{{ old('site_name', isset($settings) ? $settings->site_name : '') }}" placeholder="App Name"
                                class="form-control form-control-sm" required />
                            @error('site_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- app title  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="middlename" class="text-capitalize fs-9 form-label">Application Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', isset($settings) ? $settings->title : '') }}" placeholder="App title"
                                class="form-control form-control-sm" />
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- app email  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="lastname" class="text-capitalize fs-9 form-label">Application Email</label>
                            <input type="text" name="email" id="email" value="{{ old('email', isset($settings) ? $settings->email : '') }}" placeholder="App Email"
                                class="form-control form-control-sm" required />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- open result  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <div class="fs-7 pe-5">Open result</div>
                            <div class="d-flex gap-5 py-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="open_result" value="1"
                                        {{ old('open_result', $settings->open_result ?? '0') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label fs-9" for="open_result_yes">
                                        YES
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="open_result" value="0"
                                        {{ old('open_result', $settings->open_result ?? '0') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label fs-9" for="open_result_no">
                                        NO
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- sch open  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="school_open" class="text-capitalize fs-9 form-label">School Opens</label>
                            <input type="text" id="school_open" name="school_open" value="{{ old('school_open', isset($settings) ? $settings->school_open : '') }}"
                                class="form-control form-control-sm" required />
                            @error('school_open')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="next_term_resumption_date" class="text-capitalize fs-9 form-label">Next Term Resumption Date</label>
                            <input type="date" id="next_term_resumption_date" name="next_term_resumption_date" value="{{ old('next_term_resumption_date', isset($settings) ? $settings->next_term_resumption_date : '') }}"
                                class="form-control form-control-sm" required />
                            @error('next_term_resumption_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="term_begins" class="text-capitalize fs-9 form-label">Term Begins</label>
                            <input type="date" id="term_begins" name="term_begins" value="{{ old('term_begins', isset($settings) ? $settings->term_begins : '') }}"
                                class="form-control form-control-sm" required />
                            @error('term_begins')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="term_ends" class="text-capitalize fs-9 form-label">Term Ends</label>
                            <input type="date" id="term_ends" name="term_ends" value="{{ old('term_ends', isset($settings) ? $settings->term_ends : '') }}"
                                class="form-control form-control-sm" required />
                            @error('term_ends')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- site logo  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="site_logo" class="text-capitalize fs-9 form-label">Site Logo </label>
                            <input type="file" id="site_logo" name="site_logo" class="form-control form-control-sm" />
                            @error('site_logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- principal signature  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="principal_signature" class="text-capitalize fs-9 form-label">Principal Signature </label>
                            <input type="file" id="principal_signature" name="principal_signature" class="form-control form-control-sm" />
                            @error('principal_signature')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                         <!-- blood group  -->
                         <div class="my-1 col-12 col-md-4 text-start">
                            <label for="mobile" class="text-capitalize fs-9 form-label">App Mobile</label>
                            <input type="text" id="mobile" name="mobile"  value="{{ old('mobile', isset($settings) ? $settings->mobile : '') }}" placeholder="app mobile"
                                class="form-control form-control-sm" required />
                            @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- site desc  -->
                        <div class="my-1 col-12 col-md-6 text-start">
                            <label for="site_description" class="text-capitalize fs-9 form-label">Meta Description</label>
                            <textarea name="site_description" id="site_description" class="form-control form-control-sm" cols="10" rows="6" required>
                                {{ old('site_description', isset($settings) ? $settings->site_description : '') }}
                            </textarea>
                            @error('site_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                         <!-- site keywords  -->
                         <div class="my-1 col-12 col-md-6 text-start">
                            <label for="keywords" class="text-capitalize fs-9 form-label">Meta Keywords</label>
                            <textarea name="keywords" id="keywords" class="form-control form-control-sm" style="text-align: left;" cols="10" rows="6" required>
                                {{ old('keywords', isset($settings) ? $settings->keywords : '') }}
                            </textarea>
                            @error('keywords')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <!-- dir name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="directors_name" class="text-capitalize fs-9 form-label">Directors Name</label>
                            <input type="text" name="directors_name" value="{{ old('directors_name', isset($settings) ? $settings->directors_name : '') }}" id="directors_name" placeholder="Directors name"
                                class="form-control form-control-sm" required/>
                            @error('directors_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                         <!-- principal name  -->
                         <div class="my-1 col-12 col-md-4 text-start">
                            <label for="principal_name" class="text-capitalize fs-9 form-label">Principal Name</label>
                            <input type="text" name="principal_name" value="{{ old('principal_name', isset($settings) ? $settings->principal_name : '') }}" id="principal_name" placeholder="principal name"
                                class="form-control form-control-sm" required/>
                            @error('principal_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="my-1 col-12 col-md-4 text-start"></div>
                        <!-- Residential address  -->
                        <div class="my-1 col-12 text-start">
                            <label for="address" class="text-capitalize fs-9 form-label">Address</label>
                            <input type="text" name="address" id="address" placeholder="Residential Address"
                                class="form-control form-control-sm" value="{{ old('address', isset($settings) ? $settings->address : '') }}" required />
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <h3 class="fw-bold fs-6 pt-4">Update Username & Password(Optional)</h3>
                        <div class="my-1 col-12 text-start">
                            <label for="Username" class="text-capitalize fs-9 form-label">Username</label>
                            <input type="text" name="username" id="Username" value="{{ $username }}" placeholder="Enter Username"
                                class="form-control form-control-sm" required/>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Password" class="text-capitalize fs-9 form-label">Create
                                new Password(Optional)</label>
                            <input type="password" name="password" id="Password" placeholder="Enter Password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"/>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="confirmPassword" class="text-capitalize fs-9 form-label">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password"
                                class="form-control form-control-sm"/>
                        </div>

                        <button type="submit" class="btn my-4 btn-secondary text-capitalize">Update Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
