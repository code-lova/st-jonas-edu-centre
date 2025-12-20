@extends('layouts.dashboard.student.result-layout')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

    <p id="examinationTerm" class="text-capitalize p-2 fs-4">{{ $termSession->name }} examination result</p>

    <!-- The result wrapper -->
    <div class="border-green m-md-4 m-1   ">
        <!-- The container for the Student result details-->
        <div class="result-student-deatils row m-1">
            <!-- student Image -->
            <div class=" col-md-3 col-12 d-flex justify-content-center align-items-center">
                @if ($student->passport == Null)
                    <img width="180" height="180" style="border-radius: 5px" src="{{ asset('assets/images/avatar.png') }}" alt="{{ $student->firstname }}">
                @else
                    <img width="230" height="200" style="border-radius: 5px" src="{{ asset('uploads/'.$student->passport) }}" alt="{{ $student->firstname }}">
                @endif

            </div>
            <!-- student personal and school deatils -->
            <div class="col-md-3 col-12  d-flex flex-column align-items-start justify-content-center border-1 mt-md-0 mt-1 ">
                <p class="   text-capitalize" id="studentName">Name: {{ $student->firstname }} {{ $student->middlename ?? '' }} {{ $student->lastname }}</p>
                <p class="   text-capitalize" id="session">session: {{ $termSession->session->name }}</p>
                <p class="   text-capitalize" id="schoolOpen">school open: {{ $schoolOpens }}</p>
            </div>
            <div class="col-md-3 col-12 d-flex flex-column align-items-start justify-content-center border-1">
                <p class=" text-center  text-capitalize" id="studentClass">class: {{ $student->currentClassApplying->class_name }}</p>
                <p class=" text-center  text-capitalize" id="term">Term: {{ $termSession->name }}</p>
                <p class=" text-center  text-capitalize" id="timesPresent">Times persent: {{ $numberOfTimesPresent }}</p>
            </div>
            <div class="col-md-3 col-12 d-flex flex-column align-items-start justify-content-center border-1">
                <p class=" text-center  text-capitalize" id="termEnds">Term ends: {{ \Carbon\Carbon::parse($termEnd)->translatedFormat('D, d M Y') }}</p>
                <p class="   text-capitalize" id="numberInClass">No. in class: {{ $numInClass }}</p>
                {{-- <p class=" text-center  text-capitalize" id="studentPosition">position: {{ $position }}</p> --}}
            </div>

        </div>

        <!-- The table result -->
        <div class="result-table m-md-3 table-responsive-md">
            <table class="table table-sm table-bordered text-center">
                <thead class="text-capitalize">
                    <tr class="">
                        <th class="col text-start">Subjects</th>
                        <th class="col">Test 1</th>
                        <th class="col">Test 2</th>
                        <th class="col">exam</th>
                        <th class="col">total</th>
                        <th class="col">grade</th>
                        <th class="col">remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scoreBreakdown as $item)
                        <tr>
                            <td class="text-start">{{ $item['subject'] }}</td>
                            <td>{{ number_format($item['first_test']) ?? 0, 0}}</td>
                            <td>{{ number_format($item['second_test']) ?? 0, 0}}</td>
                            <td>{{ number_format($item['exam']) ?? 0, 0}}</td>
                            <td>{{ $item['total'] }}</td>
                            <td>{{ $item['grade'] }}</td>
                            <td>{{ $item['remark'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- The table sum -->
        <div class="result-sum d-flex align-items-center justify-content-evenly my-3">
            <p id="termTotal" class="text-white text-uppercase pt-2">
                Term's Total : {{ $termTotal }}
            </p>
            <p id="termAverage" class="text-white text-uppercase pt-2">
                Term's Average: {{ $termAverage }}%
            </p>
        </div>

        <!-- Techers and Principal remark -->
        <div class="remark d-flex justify-content-between ">
            <div class="remark-content m-2 ">
                <p id="nextTermBegin">Next Term Begins: {{ \Carbon\Carbon::parse($nextTermResums)->translatedFormat('D, d M Y') }}</p>
                <p id="classTeacherName">Class Teacher's Name: {{ $teacherName->firstname }} {{ $teacherName->middlename ?? '' }} {{ $teacherName->lastname }} </p>
                <p id="classTecherRemark">Class Teacher's Remark: {{ $teacherComment }}.</p>
                <p id="principalRemark">Principal's Remark: {{ $principalComment }}</p>
                <p id="directorName">Director's Name: {{ $directorName }}</p>
            </div>

            <div class="principal-signature m-2 border-3  d-md-flex align-items-center d-none ">
                <img src="{{ asset('uploads/'.$principalSignature) }}" alt="Principal Signature image" srcset="">
            </div>
        </div>

        <!-- character development and pyscho skills -->
        <div class="charcter-devlopment m-2 row">

            <!-- character development -->
            <div class="border-green col-md-3 col-12">
                <h2 class="text-capitalize fs-4 text-capitalize text-center"> character devlopment</h2>
                <p id="punctuality" class="d-flex justify-content-between">1. Punctuality    <span id="puntualityRating">5</span></p>
                <p id="senseOfRespnosibility" class="d-flex justify-content-between">2. Sense of Responsibility    <span id="rensponsibilityRating">5</span></p>
                <p id="reliability" class="d-flex justify-content-between">3. Reliability   <span id="reliablityRating">5</span></p>
                <p id="honesty" class="d-flex justify-content-between">4. Honesty    <span id="honestyRating">5</span></p>
                <p id="oganizationalAbility" class="d-flex justify-content-between">5. Organizational Ability    <span id="oganizationalAbilityRating">5</span></p>
                <p id="spiritOfCooperation" class="d-flex justify-content-between">6. Spirit of Co-operation    <span id="spiritOfCooperationRating">5</span></p>
                <p id="participationAtWork" class="d-flex justify-content-between">7. Participation at Work    <span id="participationAtWorkRating">5</span></p>
                <p id="attentiveness" class="d-flex justify-content-between">8. Attentiveness   <span id="attentiveness Rating">5</span></p>

            </div>

                <!-- PYSCHOMOTOR DOMAIN SKILLS -->
            <div class="skill col-md-3 col-12 border-green">
                <h2 class="text-capitalize fs-4 text-capitalize text-center"> pyschomotor domain </h2>
                <p id="handing" class="d-flex justify-content-between">1. Handing   <span id="handingRating">5</span></p>
                <p id="crafts" class="d-flex justify-content-between">2. Crafts   <span id="craftRating">5</span></p>
                <p id="Fluency" class="d-flex justify-content-between">3. Fluency    <span id="FluencyRating">5</span></p>
                <p id="drawing" class="d-flex justify-content-between">4. Drawing and Painting   <span id="drawingRating">5</span></p>
                <p id="handlingTools" class="d-flex justify-content-between">5. Handling Tools   <span id="handlingToolsRating">5</span></p>
                <p id="games" class="d-flex justify-content-between">6. Games   <span id="drawingRating">5</span></p>
                <p id="sportGymnatics" class="d-flex justify-content-between">7. Sport Gymnastics   <span id="handlingToolsRating">5</span></p>

            </div>

                <!-- Keys to Grading -->
            <div class="grade-key col-md-3 col-12 border-green">
                <h2 class="text-capitalize fs-4 text-capitalize text-center"> Keys to grading </h2>
                <p  class="d-flex justify-content-between">80 - 100 = A+   <span>Excellent</span></p>
                <p  class="d-flex justify-content-between">70 - 79 =  A    <span>Excellent</span></p>
                <p  class="d-flex justify-content-between">60 - 69 =  B    <span>Very Good</span></p>
                <p  class="d-flex justify-content-between">50 - 59 =  C    <span>Good</span></p>
                <p  class="d-flex justify-content-between">45 - 49  = D    <span>Average</span></p>
                <p  class="d-flex justify-content-between">40 - 44  = E    <span>Pass</span></p>
                <p  class="d-flex justify-content-between">0  - 39  = F    <span>Fail</span></p>
            </div>

                <!-- keys to Rating -->
            <div class="character-key col-md-3 col-12 border-green">
                <h2 class="text-capitalize fs-4 text-capitalize text-center"> Keys to Rating </h2>
                <p  class="d-flex justify-content-between">5   <span>Excellent</span></p>
                <p  class="d-flex justify-content-between">4   <span>Very Good</span></p>
                <p  class="d-flex justify-content-between">3   <span>Good</span></p>
                <p  class="d-flex justify-content-between">2   <span>Fair</span></p>
                <p  class="d-flex justify-content-between">1   <span>Poor</span></p>
            </div>

        </div>



    </div>




@endsection
