<div class="offcanvas bg-green  text-light offcanvas-start" tabindex="-1" id="mobileMenu"
    aria-labelledby="mobileMenuLabel">
    <div class="d-flex justify-content-between align-items-center">
        <div class="px-1">
            <div class="pt-3 pb-2 align-items-center d-flex">
                @if (Auth::user()->passport == Null)
                    <img width="100" height="100" class="img-fluid circle-img" src="{{ asset('assets/images/avatar.png') }}" alt="{{ Auth::user()->firstname }}">
                @else
                    <img width="230" height="200" class="img-fluid circle-img" src="{{ asset('uploads/'.Auth::user()->passport) }}" alt="{{ Auth::user()->firstname }}">
                @endif
              <div class="px-2">
                <div class="fw-semibold fs-6">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </div>
                <div class="fs-8">{{ Auth::user()->currentClassApplying->class_name }}</div>
              </div>
            </div>
        </div>
        <div class="d-flex justify-content-end px-3 py-2" data-bs-toggle="offcanvas" type="button"
        aria-controls="mobileMenu" data-bs-target="#offcanvasNavbar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle"
            viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
        </svg>
        </div>
    </div>
    <hr class="p-0 text-light">

    <div class="d-grid pt-1 gap-2">
        <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
            {{ Request::is('student/dashboard') ? 'bg-white text-dark fw-bold' : 'small-menu-active' }}"
            href="{{ url('/student/dashboard') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-activity"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                </svg>Dashboard
            </div>
        </a>
        <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
            {{ Route::currentRouteName() == 'result' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
            href="{{ route('result') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path
                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z" />
                </svg>My Results
            </div>
        </a>
        <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
            {{ Route::currentRouteName() == 'fees' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
            href="{{ route('fees') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1" />
                </svg>Fees
            </div>
        </a>
        <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
            {{ Route::currentRouteName() == 'profile' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
            href="{{ route('profile') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
                viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>My Profile
            </div>
        </a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="link-underline rounded-1 small-menu-blue p-2 text-light fs-7 link-underline-opacity-0">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg>{{ __('Logout') }}
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
