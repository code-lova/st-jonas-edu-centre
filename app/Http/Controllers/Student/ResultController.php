<?php

namespace App\Http\Controllers\Student;

use DB;
use App\Models\Term;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\ResultContent;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\TeacherComment;
use Illuminate\Support\Facades\Auth;


class ResultController extends Controller
{
    public function index(){
        $student = Auth::user();
        $studentId = User::where('id', $student->id)->first();
        $studentClass = $student->current_class_applying;
        $currentTermSession = Term::with('session')->where('status', '1')->first();


        $data['title'] = "View Result Sheet";
        $data['settings'] = Settings::find(1);
        $data['studentId'] = $studentId;
        $data['classId'] = $studentClass;
        $data['currentTermSession'] = $currentTermSession;

        return view('dashboards.student.result', $data);
    }



    private function getGradeAndRemark($total) {
        if ($total >= 80) {
            return ['grade' => 'A+', 'remark' => 'Excellent'];
        } elseif ($total >= 70) {
            return ['grade' => 'A', 'remark' => 'Excellent'];
        } elseif ($total >= 60) {
            return ['grade' => 'B', 'remark' => 'Very Good'];
        } elseif ($total >= 50) {
            return ['grade' => 'C', 'remark' => 'Good'];
        } elseif ($total >= 45) {
            return ['grade' => 'D', 'remark' => 'Fair'];
        } elseif ($total >= 40) {
            return ['grade' => 'E', 'remark' => 'Pass'];
        } else {
            return ['grade' => 'F', 'remark' => 'Fail'];
        }
    }


    private function ordinal($number) {
        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return $number . 'th';
        }
        return $number . $ends[$number % 10];
    }


    public function getStudentResult(Request $request){

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:classes,id',
            'session_id' => 'required|exists:sessions,id',
            'term_id' => 'required|exists:terms,id',
        ]);


        $student = User::with([
            'scores' => fn($q) => $q->where([
                'session_id' => $request->session_id,
                'term_id' => $request->term_id,
                'class_id' => $request->class_id,
            ])->with('subject'),

            'comments' => fn($q) => $q->where([
                'session_id' => $request->session_id,
                'term_id' => $request->term_id,
                'class_id' => $request->class_id,
            ]),
            'attendance' => fn($q) => $q->where([
                'session_id' => $request->session_id,
                'term_id' => $request->term_id,
                'class_id' => $request->class_id,
            ])
            ->limit(1),
            'teacherComment' => fn($q) => $q->where([
                'session_id' => $request->session_id,
                'term_id' => $request->term_id,
                'class_id' => $request->class_id,
            ])
            ->limit(1),

        ])->findOrFail($request->student_id);

        // 👇 ADD THIS CHECK -- as important as callback if error exist:
        if ($student->scores->isEmpty() ||
        $student->scores->first()->session_id != $request->session_id ||
        $student->scores->first()->term_id != $request->term_id) {

            return redirect()->back()->with('error', 'Invalid session or term for the selected student.');
        }

        $getRCD = ResultContent::find(1);

        // Check if class_id from scores matches class_id in ResultContent table
        if (!$getRCD || $getRCD->class_id !== optional($student->scores->first())->class_id) {
            return redirect()->back()->with('error', 'Mismatch in class information.');
        }
        // If match, assign number_in_class
        $numInClass = $getRCD->number_in_class ?? 0;


        $schoolOpens = Settings::find(1)?->school_open ?? 0;
        $termBegin = Settings::find(1)?->term_begins ?? 'N/A';
        $termEnd = Settings::find(1)?->term_ends ?? 'N/A';
        $nextTermResums = Settings::find(1)?->next_term_resumption_date ?? 'N/A';
        $directorName = Settings::find(1)?->directors_name ?? 'N/A';
        $principalSignature = Settings::find(1)?->principal_signature ?? 'SIGNED';


        $teacherName = optional($student->scores->first()->teacher) ?? 'N/A';

        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $teacherComment = optional($student->teacherComment->first())->comment ?? 'N/A';
        $principalComment = optional($student->comments->first())->comment ?? 'N/A';


        // Score calculation
        $scoreBreakdown = [];
        $termTotal = 0;

        foreach ($student->scores as $score) {
            $total = $score->first_test + $score->second_test + $score->exam;
            $termTotal += $total;

            $gradeData = $this->getGradeAndRemark($total);

            $scoreBreakdown[] = [
                'subject' => $score->subject?->subject_name ?? 'N/A',
                'first_test' => $score->first_test,
                'second_test' => $score->second_test,
                'exam' => $score->exam,
                'total' => $total,
                'grade' => $gradeData['grade'],
                'remark' => $gradeData['remark'],
            ];
        }

        $subjectCount = count($scoreBreakdown);
        $termAverage = $subjectCount > 0 ? round($termTotal / $subjectCount, 2) : 0;

        // Get all students' total scores for ranking
        $scores = Score::where('class_id', $request->class_id)
        ->where('term_id', $request->term_id)
        ->where('session_id', $request->session_id)
        ->get()
        ->groupBy('student_id');

        $studentTotals = [];

        foreach ($scores as $studentId => $studentScores) {
            $total = $studentScores->sum(function ($score) {
                return $score->first_test + $score->second_test + $score->exam;
            });

            $studentTotals[] = (object)[
                'student_id' => $studentId,
                'total' => $total
            ];
        }

        // Sort by total descending
        $sorted = collect($studentTotals)->sortByDesc('total')->values();

        // Assign ranks with tie support
        $rankings = [];
        $prevTotal = null;
        $currentRank = 0;
        $skip = 1;

        foreach ($sorted as $index => $item) {
            if ($item->total !== $prevTotal) {
                $currentRank += $skip;
                $skip = 1;
            } else {
                $skip++;
            }

            $rankings[$item->student_id] = $currentRank;
            $prevTotal = $item->total;
        }


        $currentStudentPosition = $rankings[$request->student_id] ?? null;
        $positionFormatted = $currentStudentPosition ? $this->ordinal($currentStudentPosition) : 'N/A';



        $data = [
            'title' => "My Result Sheet",
            'student' => $student,
            'termSession' => $currentTermSession,
            'numInClass' => $numInClass,
            'scoreBreakdown' => $scoreBreakdown,
            'termTotal' => $termTotal,
            'termAverage' => $termAverage,
            'teacherName' => $teacherName,
            'position' => $positionFormatted,
            'directorName' => $directorName,
            'schoolOpens' => $schoolOpens,
            'termBegin' => $termBegin,
            'termEnd' => $termEnd,
            'nextTermResums' => $nextTermResums,
            'principalSignature' => $principalSignature,

            'teacherComment' => $teacherComment,
            'principalComment' => $principalComment,
        ];

        return view('dashboards.student.result-view', $data);

    }


}
