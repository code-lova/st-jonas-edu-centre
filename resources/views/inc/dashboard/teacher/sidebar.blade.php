<div class="col-3 bg-blue text-light container d-none d-md-block">
    <section class="side-nav text-light d-flex flex-column py-4">
        <div class="flex-grow-1">
        <div class="py-2">
            <div class="fw-semibold fs-6">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </div>
            <div class="fs-8">{{ Auth::user()->email ?? 'tutor@email.com' }}</div>
        </div>
        <div class="d-grid pt-3 pb-1 p-0">

            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Request::is('teacher/dashboard') ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ url('/teacher/dashboard') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-activity" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2" />
                </svg>Dashboard
            </div>
            </a>
        </div>
        <div class="d-grid py-1 p-0">
            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Route::currentRouteName() == 'enterscore' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ route('enterscore') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-database-add" viewBox="0 0 16 16">
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                <path
                    d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                </svg>Enter Scores
            </div>
            </a>
        </div>
        <div class="d-grid py-1 p-0">
            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Route::currentRouteName() == 'comment.list' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ route('comment.list') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
            </svg>Comments
            </div>
            </a>
        </div>
        <div class="d-grid py-1 p-0">
            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Route::currentRouteName() == 'result.content' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ route('result.content') }}">
              <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                    <path d="M5.5 7a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 4.5L9.5 1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                </svg>
                    Result Contents
              </div>
            </a>
        </div>
        <div class="d-grid py-1 p-0">
            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Route::currentRouteName() == 'attendance' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ route('attendance') }}">
              <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-calendar-check" viewBox="0 0 16 16">
                    <path d="M10.854 8.354a.5.5 0 0 0-.708-.708L8.5 9.293 7.354 8.146a.5.5 0 1 0-.708.708L8.5 10.707l2.354-2.353z"/>
                    <path d="M1 2.5A.5.5 0 0 1 1.5 2H2V1a.5.5 0 0 1 1 0v1h10V1a.5.5 0 0 1 1 0v1h.5a.5.5 0 0 1 .5.5V4H1V2.5zm0 1.5h14v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4z"/>
                </svg>
                    Attendance
              </div>
            </a>
        </div>
        <div class="d-grid py-1 p-0">
            <a class="link-underline rounded-1 p-2 text-light fs-7 link-underline-opacity-0
                {{ Route::currentRouteName() == 'my.profile' ? 'bg-white text-dark fw-bold' : 'small-menu-blue' }}"
                href="{{ route('my.profile') }}">
            <div class="d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person" viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>My Profile
            </div>
            </a>
        </div>
        <hr class="text-light" />
        </div>
        <div class="d-grid py-1 p-0">
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
    </section>
</div>
