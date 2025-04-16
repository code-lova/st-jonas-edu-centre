<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Term;
use App\Models\User;
use App\Models\Classes;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\TeacherComment;
use App\Models\TeacherSubjects;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeacherCommentController extends Controller
{
    public function index(){

        $teacher = Auth::user();
        $teacherId = $teacher->id;

        // Get all subjects & classes the teacher teaches
        // $assignments = TeacherSubjects::with('subject', 'class')
        // ->where('user_id', $teacherId)
        // ->get();
        // Check if teacher is a class teacher (class_teacher not null and exists in classes table)

        $classTeacherClass = null;
        $isClassTeacher = false;

        if (!is_null($teacher->class_teacher)) {
            // Get the class that the logged in user is assigned a class teacher
            $classTeacherClass = Classes::find($teacher->class_teacher);
            $isClassTeacher = $classTeacherClass !== null;
        }
        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $data['title'] = "Comment Dashboard";
        $data['sessions'] = Session::all();
        $data['terms'] = Term::all();
        $data['teacherId'] = $teacherId;
        $data['classTeacherClass'] = $classTeacherClass;
        $data['isClassTeacher'] = $isClassTeacher;
        $data['currentTermSession'] =$currentTermSession;

        //$data['classAssigned'] = $assignments;

        $data['comments'] = TeacherComment::where('teacher_id', $teacherId)->where('class_id', $classTeacherClass->id)->latest()->get();
        return view('dashboards.teacher.comments', $data);
    }

    public function getStudentsByClass(Request $request)
    {
        $classId = $request->class_id;

        $students = User::where('role', 'student')
            ->where('current_class_applying', $classId)
            ->get(['id', 'firstname', 'lastname']);

        return response()->json($students);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id',
            'term_id' => 'required|exists:terms,id',
            'class_id' => 'required|exists:classes,id',
            'student_id' => 'required|exists:users,id',
            'teacher_id' => 'required|exists:users,id',
            'comment' => 'required|max:1000',
        ], [
            'session_id.required' => 'Academic session is required.',
            'term_id.required' => 'Academic term is required.',
            'class_id.required' => 'The student class is required.',
            'student_id.required' => 'Student ID is required.',
            'teacher_id.required' => 'Teacher ID is required.',
            'comment.required' => 'Comment cannot be empty.',
            'comment.max' => 'Comment must not exceed 1000 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        // Check if the user already has 1 comments for the same teacher, session, term, and class
        $existingCommentCount = TeacherComment::where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->where('class_id', $request->class_id)
            ->where('student_id', $request->student_id)
            ->where('teacher_id', $request->teacher_id)
            ->count();

        if ($existingCommentCount >= 1) {
            return redirect()->back()->with('error', 'You already gave this student a comment.');
        }

        // Create and save the comment
        TeacherComment::create([
            'session_id' => $request->session_id,
            'term_id' => $request->term_id,
            'class_id' => $request->class_id,
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('message', 'Comment saved successfully!');
    }


    public function destroy($id)
    {
        $class = TeacherComment::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully!');
    }

}
