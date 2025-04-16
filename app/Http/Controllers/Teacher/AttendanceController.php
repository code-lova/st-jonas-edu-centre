<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Session;
use App\Models\StudentAttendance;
use App\Models\Term;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{

    public function index(){


        $teacher = Auth::user();
        $teacherId = $teacher->id;

         // Check if teacher is a class teacher (class_teacher not null and exists in classes table)
         $classTeacherClass = null;
         $isClassTeacher = false;

         if (!is_null($teacher->class_teacher)) {
             // Get the class that the logged in user is assigned a class teacher
             $classTeacherClass = Classes::find($teacher->class_teacher);
             $isClassTeacher = $classTeacherClass !== null;
         }

        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $data['title'] = "Attendance of students in your class";
        $data['sessions'] = Session::all();
        $data['terms'] = Term::all();
        $data['teacherId'] = $teacherId;
        $data['classTeacherClass'] = $classTeacherClass;
        $data['isClassTeacher'] = $isClassTeacher;
        $data['currentTermSession'] =$currentTermSession;

        $data['studentsUnderClassteacher'] = $classTeacherClass
        ? User::where('current_class_applying', $classTeacherClass->id)->latest()->get()
        : collect(); // return empty collection if not a class teacher


        return view('dashboards.teacher.attendance', $data);
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id',
            'term_id' => 'required|exists:terms,id',
            'class_id' => 'required|exists:classes,id',
            'student_id' => 'required|array',
            'teacher_id' => 'required|exists:users,id',
            'times_present' => 'required|array',
        ], [
            'session_id.required' => 'Academic session is required.',
            'term_id.required' => 'Academic term is required.',
            'class_id.required' => 'The student class is required.',
            'student_id.required' => 'Student ID is required.',
            'teacher_id.required' => 'Teacher ID is required.',
            'times_present.required' => 'Comment cannot be empty.',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }


        foreach ($request->student_id as $index => $studentId) {
            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'session_id' => $request->session_id,
                    'term_id' => $request->term_id,
                    'class_id' => $request->class_id,
                ],
                [
                    'teacher_id' => $request->teacher_id,
                    'times_present' => $request->times_present[$index],
                ]
            );
        }

        return redirect()->route('attendance')->with('message', 'Attendance records saved successfully.');
    }




    public function fetchAttendance(Request $request)
    {
        $attendances = StudentAttendance::where([
            ['class_id', $request->class_id],
            ['session_id', $request->session_id],
            ['term_id', $request->term_id]
        ])->get();

        return response()->json($attendances);
    }







}
