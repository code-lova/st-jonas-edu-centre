@extends('layouts.login.teacher.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-md-end justify-content-center py-4 col-md-4">
                <a href="/" class="fs-5 fw-bold text-light">
                    <div><img src="/assets/icons/st jonas.jpg" alt="St Jonas" srcset=""></div>
                    <div>Teacher Log In</div>
                </a>
            </div>
            <div class="col-12 col-md-8 d-flex justify-content-center  align-items-center">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="my-1 col-12 text-start">
                            <label for="username" class="text-capitalize fs-6 text-light form-label">{{ __('Username') }}</label>
                            <input type="text" id="email" name="email" placeholder=" Enter username"
                                class="form-control p-0 form-control-sm text-black @error('email') is-invalid @enderror" value="{{ old('email') }}"  required autocomplete="email" autofocus/>
                            @error('email')
                                <strong class="text-white">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="my-1 col-12 text-start">
                            <label for="password" class="text-capitalize fs-6 text-light form-label">Password</label>
                            <input type="password" id="password" name="password" placeholder="***********"
                                class="form-control p-0 form-control-sm text-black @error('password') is-invalid @enderror" required autocomplete="current-password"/>
                            @error('password')
                                <strong class="text-white">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="pt-3 d-grid col-12 text-start">
                            <button type="submit" class="btn btn-light text-blue btn-sm fs-7 text-capitalize">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
