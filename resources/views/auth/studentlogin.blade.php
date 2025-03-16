@extends('layouts.login.student.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-md-end justify-content-center py-4 col-md-4">
                <a href="/" class="fs-5 fw-bold text-light">
                    <div><img src="/assets/icons/st jonas.jpg" alt="Dominion Harvard" srcset=""></div>
                    <div>Student Log In</div>
                </a>
            </div>
            <div class="col-12 col-md-8 d-flex justify-content-center  align-items-center">

                <form action="/dashboard-student/" class="p-3 p-md-5 rounded-2 bg-green text-light">
                    <div class="row">
                        <div class="my-1 col-12 text-start ">
                            <label for="teacheremail" class="text-capitalize fs-6 form-label">Email</label>
                            <input type="email" id="teacheremail" placeholder=" Enter email"
                                class="form-control p-0 form-control-sm text-black" required/>
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="password" class="text-capitalize fs-6 text-light form-label">Enter
                                Password</label>
                            <input type="password" id="password" placeholder="Enter Password"
                                class="form-control p-0 form-control-sm text-black" required/>
                        </div>

                        {{-- <!-- This the div for the error alert box -->
                        <div id="alertContainer" class="col-12">
                            <div id="errorAlert"  class="mt-2 fs-6" style="background-color: rgba(255, 0, 0, 0.379); text-align: center;">Invalid username or password.</div>
                            <div id="successAlert" class="mt-2 fs-6" style="background-color: rgba(0, 128, 0, 0.379); text-align: center;">You have signed in successfully.</div>
                        </div>
                        <!-- End of the div for the error alert box --> --}}


                        <div class="pt-3 d-grid col-12 text-start">
                            <input type="submit" value="Log In"
                                class="btn btn-light btn-sm fs-7 text-green text-capitalize">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
