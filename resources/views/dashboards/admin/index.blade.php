@extends('layouts.dashboard.admin.layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

<style>

    table {
        width: 100%;
        border-collapse: collapse;

    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #f4f4f4;
    }
    button {
        padding: 5px 10px;
        margin: 2px;
        border: none;
        color: #fff;
        cursor: pointer;
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
            <div class="fs-6 fw-bold text-red align-self-center ">Dashboard</div>
        </div>
        <div class="bg-light vh-100 px-3 rounded" >
            <div class="text-start px-2 py-5">
                @if ($noTermActive)
                    <div class="alert alert-warning">
                        Note: First create a term, then retrun here to activate it below.
                    </div>
                @endif

              <div class="fs-6 d-flex">
                Welcome Admin
                     <div class="px-1 fw-semibold">{{ $user->lastname }}</div>
              </div>
              <div class="fs-7">
                Hope you are having a great time
              </div>
            </div>
            <div class="d-flex gap-3">
              <a href="{{ route('staff.list') }}" class="btn btn-secondary btn-sm fs-7">View Staff</a>
              <a href="{{ route('studentlist') }}" class="btn btn-sm btn-secondary fs-7">View Student</a>
            </div>

                <!-- The analytics of the school( Staffs and Students) -->
        <div class="bg-red text-light mt-4 rounded">
            <div class="text-center py-2">
              <div class="fs-3  text-uppercase fw-semibold">
                School Analytics
              </div>
            </div>
            <div class="d-flex gap-3">
                <div
                         class="d-flex py-2 gap-2 col-md-6  align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                        class="bi bi-award" viewBox="0 0 16 16">
                        <path
                            d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                    </svg>
                    <div>
                        <div id="staffNumbers" class="display-7 text-start fw-semibold">{{ $numOfStaff }}</div>
                        <div class="fs-5">Register Staffs</div>
                    </div>
                </div>

                <div
                  class="d-flex gap-2 col-md-6 align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-mortarboard" viewBox="0 0 16 16">
                        <path
                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z" />
                        <path
                            d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z" />
                    </svg>
                    <div>
                        <div id="studentNumber" class="display-7 text-start fw-semibold">{{ $numOfStudent }}</div>
                        <div class="fs-5">Register Students</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <!-- Table detail -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Session</th>
                        <th>Term</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="classTableBody">
                    @forelse ( $term as $k=>$val )
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $val->session->name }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->start_date, date('Y/m/d') }}</td>
                            <td>{{ $val->end_date,  date('Y/m/d') }}</td>
                            <td>
                                @if ($val->status == 0)
                                    <a href="{{ url('admin/activate-term/'.$val->id) }}" class="btn btn-secondary btn-sm fs-7">Activate</a>
                                @elseif ($val->status == 1)
                                    <div class="px-1 fw-semibold" style="color: rgb(22, 109, 22)">Active Term ✅</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Term has not be created yet</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>
</section>


@endsection
