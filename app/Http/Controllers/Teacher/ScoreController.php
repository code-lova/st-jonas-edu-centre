<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Session;
use App\Models\Subject;
use App\Models\TeacherSubjects;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Author;

class ScoreController extends Controller
{
    public function create(){
        $data['title'] = "Manage Score";
        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $data['sessions'] = Session::all();
        $data['terms'] = Term::all();
        $data['currentTermSession'] =$currentTermSession;
        return view('dashboards.teacher.manage-score', $data);
    }


    public function handleSessionTermSelection(Request $request) {

        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id',
            'term_id' => 'required|exists:terms,id',
        ], [
            'session_id.required' => 'Academic session is required.',
            'term_id.required' => 'Academic term is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $teacherId = auth()->id();
        $sessionId = $request->session_id;
        $termId = $request->term_id;

        // Get all subjects & classes the teacher teaches in the selected session and term
        $assignments = TeacherSubjects::with('subject', 'class')
            ->where('user_id', $teacherId)
            ->get();

        $session = Session::find($sessionId);
        $term = Term::find($termId);


        $data['sessionId'] = $sessionId;
        $data['termId'] = $termId;
        $data['assignments'] = $assignments;
        $data['session'] = $session;
        $data['term'] = $term;

        $data['title'] = "Select Subjects";
        return view('dashboards.teacher.subjects', $data);
    }



    public function showScoreForm(Request $request) {

        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');
        $sessionId = $request->input('session_id');
        $termId = $request->input('term_id');

        $students = User::where('current_class_applying', $classId)->get();

        $session = Session::find($sessionId);
        $term = Term::find($termId);
        $subject = Subject::find($subjectId);
        $teacherId = auth()->id();

        // Fetch existing scores for the given class, subject, session, and term
        $scores = Score::where('session_id', $sessionId)
                        ->where('term_id', $termId)
                        ->where('class_id', $classId)
                        ->where('subject_id', $subjectId)
                        ->get();

        // Prepare scores data in an easy-to-access format
        $scoreData = [];
        foreach ($scores as $score) {
            $scoreData[$score->student_id] = $score;
        }

        $data = [
            'students' => $students,
            'classId' => $classId,
            'subjectId' => $subjectId,
            'sessionId' => $sessionId,
            'termId' => $termId,
            'session' => $session,
            'term' => $term,
            'subject' => $subject,
            'teacherId' => $teacherId,
            'scoreData' => $scoreData,
            'title' => 'Enter Scores',
        ];

        return view('dashboards.teacher.enter-score', $data);
    }


    public function saveScores(Request $request)
    {
        $scores = $request->input('scores');
        $sessionId = $request->input('session_id');
        $termId = $request->input('term_id');
        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');
        $teacherId = $request->input('teacher_id');

        foreach ($scores as $studentId => $scoreData) {
            Score::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'class_id' => $classId,
                    'subject_id' => $subjectId,
                    'session_id' => $sessionId,
                    'term_id' => $termId,
                ],
                [
                    'first_test' => $scoreData['first_test'] ?? null,
                    'second_test' => $scoreData['second_test'] ?? null,
                    'exam' => $scoreData['exam'] ?? null,
                    'teacher_id' => $teacherId,
                ]
            );
        }

        return response()->json(['message' => 'Score saved successfully.']);


    }






}
