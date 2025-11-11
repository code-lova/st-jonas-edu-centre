<?php

namespace App\Http\Controllers\Admin;

use App\Models\GraduatedStudent;
use App\Models\Classes;
use App\Models\Settings;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class GraduatedStudentController extends Controller
{
    /**
     * Display a listing of graduated students
     */
    public function index(Request $request)
    {
        $currentTermSession = Term::with('session')->where('status', '1')->first();
        $data['title'] = "Graduated Students";
        $data['currentTermSession'] = $currentTermSession;
        $data['settings'] = Settings::find(1);

        // Get filter parameters
        $academicYear = $request->get('academic_year');
        $classId = $request->get('class_id');
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'graduation_date');
        $sortDirection = $request->get('sort_direction', 'desc');

        // Build query
        $query = GraduatedStudent::with(['graduatedFromClass', 'processedBy']);

        // Apply filters
        if ($academicYear) {
            $query->byAcademicYear($academicYear);
        }

        if ($classId) {
            $query->where('graduated_from_class_id', $classId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(firstname, ' ', lastname) like ?", ["%{$search}%"]);
            });
        }

        // Apply sorting
        $query->orderBy($sortBy, $sortDirection);

        $data['graduatedStudents'] = $query->paginate(50)->appends($request->query());
        $data['classes'] = Classes::all();
        $data['academicYears'] = GraduatedStudent::getAvailableAcademicYears();
        $data['graduationStats'] = GraduatedStudent::getGraduationStats();

        // Current filter values for form persistence
        $data['currentFilters'] = [
            'academic_year' => $academicYear,
            'class_id' => $classId,
            'search' => $search,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection
        ];

        return view('dashboards.admin.graduated-students.index', $data);
    }

    /**
     * Show the details of a specific graduated student
     */
    public function show($id)
    {
        $graduatedStudent = GraduatedStudent::with(['graduatedFromClass', 'processedBy'])->findOrFail($id);

        $data['title'] = "Graduated Student Details";
        $data['graduatedStudent'] = $graduatedStudent;
        $data['settings'] = Settings::find(1);

        return view('dashboards.admin.graduated-students.show', $data);
    }

    /**
     * Export graduated students to CSV
     */
    public function export(Request $request)
    {
        // Get the same filtered query as the index
        $academicYear = $request->get('academic_year');
        $classId = $request->get('class_id');
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'graduation_date');
        $sortDirection = $request->get('sort_direction', 'desc');

        $query = GraduatedStudent::with(['graduatedFromClass']);

        // Apply same filters
        if ($academicYear) {
            $query->byAcademicYear($academicYear);
        }

        if ($classId) {
            $query->where('graduated_from_class_id', $classId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(firstname, ' ', lastname) like ?", ["%{$search}%"]);
            });
        }

        $query->orderBy($sortBy, $sortDirection);
        $graduatedStudents = $query->get();

        // Generate CSV content
        $csvData = [];
        $csvData[] = [
            'First Name',
            'Last Name',
            'Email',
            'Gender',
            'Phone Number',
            'Graduated From Class',
            'Academic Year',
            'Graduation Date',
            'Graduation Note'
        ];

        foreach ($graduatedStudents as $student) {
            $csvData[] = [
                $student->firstname,
                $student->lastname,
                $student->email,
                $student->sex,
                $student->phone_number ?? 'N/A',
                $student->graduatedFromClass->class_name,
                $student->academic_year,
                $student->graduation_date->format('Y-m-d'),
                $student->graduation_note ?? 'N/A'
            ];
        }

        // Create CSV file
        $filename = 'graduated_students_' . date('Y_m_d_H_i_s') . '.csv';

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Get graduation statistics for dashboard
     */
    public function getStats()
    {
        $stats = GraduatedStudent::getGraduationStats();
        return response()->json($stats);
    }
}
