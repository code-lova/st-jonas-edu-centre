@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

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
                <div class="fs-6 fw-bold text-red align-self-center ">Register Student</div>
            </div>
            <div class="bg-light px-3 rounded text-red">
                <form action="">
                    <div class="row pb-2">
                        <!-- first name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="firstname" class="text-capitalize fs-9 form-label">Firstname</label>
                            <input type="text" id="firstname" placeholder="Firstname"
                                class="form-control form-control-sm" required />
                        </div>
                        <!-- middle name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="middlename" class="text-capitalize fs-9 form-label">Middle Name</label>
                            <input type="text" id="middlename" placeholder="Middle Name"
                                class="form-control form-control-sm" />
                        </div>
                        <!-- last name  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="lastname" class="text-capitalize fs-9 form-label">Last Name</label>
                            <input type="text" id="lastname" placeholder="Last Name"
                                class="form-control form-control-sm" required />
                        </div>
                        <!-- gender  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <div class="fs-7 pe-5" >Sex</div>
                            <div class="d-flex gap-5 py-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex-male">
                                    <label class="form-check-label fs-9" for="sex-male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex-female"
                                        checked>
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
                            <input type="date" id="dateofbirth" value="2024-01-01"
                                class="form-control form-control-sm" required />
                        </div>
                        <!-- profile photo  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="passport" class="text-capitalize fs-9 form-label">Passport </label>
                            <input type="file" id="passport" class="form-control form-control-sm" />
                        </div>
                        <!-- place of birth  -->
                        <div class="my-1 col-12 text-start">
                            <label for="PlaceOfBirth" class="text-capitalize fs-9 form-label">Place Of
                                Birth</label>
                            <input type="text" id="PlaceOfBirth" placeholder="Place Of Birth"
                                class="form-control form-control-sm" />
                        </div>
                        <!-- blood group  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="bloodgroup" class="text-capitalize fs-9 form-label">Blood
                                Group</label>
                            <input type="text" id="bloodgroup" placeholder="Blood Group"
                                class="form-control form-control-sm" />
                        </div>
                        <!-- genotype  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="genotype" class="text-capitalize fs-9 form-label">Genotype</label>
                            <input type="text" id="genotype" placeholder="Genotype"
                                class="form-control form-control-sm"/>
                        </div>
                        <div class="my-1 col-12 col-md-4 text-start"></div>
                        <!-- Residential address  -->
                        <div class="my-1 col-12 text-start">
                            <label for="ResidentialAddress" class="text-capitalize fs-9 form-label">Residential
                                Address</label>
                            <input type="text" id="ResidentialAddress" placeholder="Residential Address"
                                class="form-control form-control-sm" />
                        </div>
                        <!-- local government of origin  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="LocalGovernmentofOrigin" class="text-capitalize fs-9 form-label">Local
                                Government of Origin</label>
                            <input type="text" id="LocalGovernmentofOrigin"
                                placeholder="Local Government of Origin" class="form-control form-control-sm" />
                        </div>
                        <!-- religion  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="Religion" class="text-capitalize fs-9 form-label">Religion</label>
                            <input type="text" id="Religion" placeholder="Religion"
                                class="form-control form-control-sm" />
                        </div>
                        <!-- Nationality -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="Nationality" class="text-capitalize fs-9 form-label">Nationality</label>
                            <input type="text" id="Nationality" placeholder="Nationality"
                                class="form-control form-control-sm" required/>
                        </div>
                        <!-- last class passed  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="LastClassPassed" class="text-capitalize fs-9 form-label">Last Class
                                Passed</label>
                            <input type="text" id="LastClassPassed" placeholder="Last Class Passed"
                                class="form-control form-control-sm" required/>
                        </div>
                        <!-- class currently applying for  -->
                        <div class="my-1 col-12 col-md-4 text-start">
                            <label for="ClassCurrentlyApplyingFor" class="text-capitalize fs-9 form-label">Class Currently Applying For</label>
                            <select name="class_id" id="ClassCurrentlyApplyingFor" class="form-control form-control-sm" required="">
                                <option value="">Select a class</option>
                                <option value="1">
                                    SS 1
                                </option>
                                <option value="2">
                                    SS 2
                                </option>
                                <option value="3">
                                    JSS 3
                                </option>

                            </select>
                        </div>
                        <h3 class="fs-6 pt-5 fw-bold">Health Information</h3>
                        <div class="my-1 col-12 d-flex gap-4 text-start">
                            <div class="fs-7 pe-5" >Do your ward behave abnormal at times
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abnormal" id="yesabnormal">
                                <label class="form-check-label fs-9" for="yesabnormal">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abnormal" id="noabnormal"
                                    checked>
                                <label class="form-check-label fs-9" for="noabnormal">
                                    No
                                </label>
                            </div>

                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="AbnormalExplanation" class="text-capitalize fs-7 form-label">If yes
                                please explain</label>
                            <input type="text" id="AbnormalExplanation" placeholder=""
                                class="form-control form-control-sm" />
                        </div>
                        <!-- childs general health  -->
                        <div class="my-1 col-12 text-start">
                            <label for="HealthCondition" class="text-capitalize fs-7 form-label">What is
                                your childs general health condition?</label>
                            <input type="text" id="HealthCondition" placeholder=""
                                class="form-control form-control-sm" />
                        </div>
                        <h3 class="fs-6 fw-bold pt-2">Parents Details</h3>
                        <div class="my-1 col-12 text-start">
                            <label for="ParentsName" class="text-capitalize fs-9 form-label">Parents
                                Name</label>
                            <input type="text" id="ParentsName" placeholder="Parents Name"
                                class="form-control form-control-sm"  />
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="ParentsAddress" class="text-capitalize fs-9 form-label">Parents
                                Address</label>
                            <input type="text" id="ParentsAddress" placeholder="Parents Address"
                                class="form-control form-control-sm"  />
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Occupation" class="text-capitalize fs-9 form-label">Occupation</label>
                            <input type="text" id="Occupation" placeholder="Occupation"
                                class="form-control form-control-sm" />
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Fathersphone" class="text-capitalize fs-9 form-label">Fathers
                                Phone</label>
                            <input type="tel" id="Fathersphone" name="Fathersphone" placeholder="Fathers number"
                                class="form-control form-control-sm" />
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Mothersphone" class="text-capitalize fs-9 form-label">Mothers
                                Phone</label>
                            <input type="tel" id="Mothersphone" name="Mothersphone" placeholder="Mothers number"
                                class="form-control form-control-sm" />
                        </div>
                        <h3 class="fw-bold fs-6 pt-4">Create Username & Password</h3>
                        <div class="my-1 col-12 text-start">
                            <label for="Username" class="text-capitalize fs-9 form-label">Username</label>
                            <input type="text" id="Username" placeholder="Enter Username"
                                class="form-control form-control-sm" required/>
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="Password" class="text-capitalize fs-9 form-label">Create
                                Password/ Change Password</label>
                            <input type="password" id="Password" placeholder="Enter Password"
                                class="form-control form-control-sm" required/>
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="confirmPassword" class="text-capitalize fs-9 form-label">Confirm
                                Password</label>
                            <input type="password" id="confirmPassword" placeholder="Confirm Password"
                                class="form-control form-control-sm" required/>
                        </div>

                        <button type="submit" class="btn my-4 btn-secondary text-capitalize">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
