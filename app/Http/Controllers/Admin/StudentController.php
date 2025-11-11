<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classes;
use App\Models\Healthinfo;
use App\Models\ParentInfo;
use App\Models\GraduatedStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Settings;
use App\Models\Term;
use App\Models\PromotionHistory;

class StudentController extends Controller
{

    public function index(){
        $currentTermSession = Term::with('session')->where('status', '1')->first();
        $data['title'] = "List of all Student";
        $data['currentTermSession'] = $currentTermSession;
        $data['settings'] = Settings::find(1);
        $data['students'] = User::where('role', 'student')->latest()->get();
        $data['classes'] = Classes::all();

        // Get student counts by class
        $studentCounts = User::where('role', 'student')
            ->selectRaw('current_class_applying, graduation_status, count(*) as count')
            ->groupBy('current_class_applying', 'graduation_status')
            ->get()
            ->groupBy('current_class_applying');

        $data['studentCounts'] = $studentCounts;

        // Check if there's a recent promotion that can be rolled back
        $data['canRollback'] = PromotionHistory::canRollback();
        $data['lastPromotionBatch'] = PromotionHistory::getLatestRollbackableBatch();

        return view('dashboards.admin.student.index', $data);
    }

    // public function filterByClass(int $classId)
    // {
    //     $students = User::where('current_class_applying', $classId)
    //         ->with(['currentClassApplying'])
    //         ->get();

    //     return response()->json($students);
    // }



    public function create(){
        $data['title'] = "Create New Student";
        $data['classes'] = Classes::all();
        return view('dashboards.admin.student.create', $data);
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Create new student user
            $user = User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'passport' => null, // Will be updated if uploaded
                'class_teacher' => null,
                'place_of_birth' => $request->place_of_birth,
                'blood_group' => $request->blood_group,
                'genotype' => $request->genotype,
                'residential_address' => $request->residential_address,
                'local_govt_origin' => $request->local_govt_origin,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'previous_school' => $request->previous_school,
                'last_class_passed' => $request->last_class_passed,
                'current_class_applying' => $request->current_class_applying,
            ]);

            // Handle passport upload if provided
            if ($request->hasFile('passport')) {
                $file = $request->file('passport');
                $filename = 'passport_' . time() . '.' . $file->hashName();
                $file->move('uploads', $filename);

                // Update user with passport path
                $user->update(['passport' => $filename]);
            }

            // Insert health info
            Healthinfo::create([
                'user_id' => $user->id,
                'abnormal_behaviour' => $request->abnormal_behaviour === 'Yes' ? 1 : 0,
                'description' => $request->description,
                'child_general_health_condition' => $request->child_general_health_condition,
            ]);

            // Insert parent info
            ParentInfo::create([
                'user_id' => $user->id,
                'parent_name' => $request->parent_name,
                'parent_address' => $request->parent_address,
                'occupation' => $request->occupation,
                'fathers_phone' => $request->fathers_phone,
                'mothers_phone' => $request->mothers_phone,
            ]);

            DB::commit(); // Commit transaction

            return redirect()->route('studentlist')->with('message', 'Student registered successfully!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if any error occurs
            Log::error('Student registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to register student. Check logs.');
        }
    }

    public function edit($id){
        $data['title'] = "Student Information";
        $data['user'] = User::with(['healthInfo', 'parentInfo', 'currentClassApplying', 'lastClassPassed'])->where('id', $id)->firstOrFail();
        return view('dashboards.admin.student.edit', $data);
    }

    public function update($id){
        $data['title'] = "Update Student Information";
        $data['classes'] = Classes::all();
        $data['user'] = User::with(['healthInfo', 'parentInfo', 'currentClassApplying', 'lastClassPassed'])->where('id', $id)->firstOrFail();
        return view('dashboards.admin.student.update', $data);
    }

    public function updateStudent(UpdateStudentRequest $request, $id){
        try {
            DB::beginTransaction(); // Start transaction

            // Find the student
            $user = User::with(['healthInfo', 'parentInfo'])->where('id', $id)->firstOrFail();

            // Update user details
            $user->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,

                'role' => 'student',
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'passport' => null,
                'class_teacher' => null,
                'place_of_birth' => $request->place_of_birth,
                'blood_group' => $request->blood_group,
                'genotype' => $request->genotype,
                'residential_address' => $request->residential_address,
                'local_govt_origin' => $request->local_govt_origin,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'previous_school' => $request->previous_school,
                'last_class_passed' => $request->last_class_passed,
                'current_class_applying' => $request->current_class_applying,
            ]);

            // Update password only if provided
            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            // Handle passport upload if provided
            if ($request->hasFile('passport')) {
                $file = $request->file('passport');
                $filename = 'passport_' . time() . '.' . $file->hashName();
                $file->move('uploads', $filename);
                $user->update(['passport' => $filename]);
            }

            // Update health info
            if ($user->healthInfo) {
                $user->healthInfo->update([
                    'abnormal_behaviour' => $request->abnormal_behaviour === 'Yes' ? 1 : 0,
                    'description' => $request->description,
                    'child_general_health_condition' => $request->child_general_health_condition,
                ]);
            }

            // Update parent info
            if ($user->parentInfo) {
                $user->parentInfo->update([
                    'parent_name' => $request->parent_name,
                    'parent_address' => $request->parent_address,
                    'occupation' => $request->occupation,
                    'fathers_phone' => $request->fathers_phone,
                    'mothers_phone' => $request->mothers_phone,
                ]);
            }

            DB::commit(); // Commit transaction

            return redirect()->route('studentlist')->with('message', 'Student information updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if any error occurs
            Log::error('Student update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update student. Check logs.');
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction(); // Start transaction

            $user = User::findOrFail($id);

            // Ensure the user is a student (optional: customize based on role column if applicable)
            if ($user->role !== 'student') {
                return redirect()->back()->with('error', 'Only student can be deleted.');
            }

            // Delete related records (example: TeacherSubjects, if applicable)
            $user->subjects()->detach(); // If there's a many-to-many relationship
            $user->healthInfo()->delete();
            $user->parentInfo()->delete();
            $user->comments()->delete();

            // Delete user record
            $user->delete();

            DB::commit(); // Commit transaction

            return redirect()->back()->with('message', 'student deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs
            Log::error('student deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete student. Check logs.');
        }
    }

    /**
     * Automatically promote all students across all classes to their next class
     * Students in SS3 (final class) will be flagged as graduating
     */
    public function promoteAllStudents()
    {
        try {
            DB::beginTransaction();

            $classHierarchy = User::getClassHierarchy();
            $promotionResults = [];
            $totalPromoted = 0;
            $totalGraduating = 0;

            // Generate unique batch ID for this promotion session
            $batchId = 'PROMO_' . date('Y_m_d_H_i_s') . '_' . uniqid();

            // Process promotions in reverse order to avoid conflicts
            // Start with highest classes and work down
            foreach (array_reverse($classHierarchy, true) as $currentClassId => $nextClassId) {

                // Get all active students in current class
                $students = User::where('role', 'student')
                               ->where('current_class_applying', $currentClassId)
                               ->where('graduation_status', 'active')
                               ->get();

                if ($students->isEmpty()) {
                    continue;
                }

                $currentClass = Classes::find($currentClassId);
                $studentCount = $students->count();

                if ($nextClassId === null) {
                    // SS3 - Move students to graduated_students table
                    $currentAcademicYear = GraduatedStudent::getCurrentAcademicYear();

                    foreach ($students as $student) {
                        // Create graduated student record
                        GraduatedStudent::create([
                            'firstname' => $student->firstname,
                            'lastname' => $student->lastname,
                            'email' => $student->email,
                            'sex' => $student->sex,
                            'date_of_birth' => $student->date_of_birth,
                            'phone_number' => $student->phone_number,
                            'address' => $student->address,
                            'profile_pic' => $student->profile_pic,
                            'student_id' => $student->id,
                            'graduated_from_class_id' => $currentClassId,
                            'academic_year' => $currentAcademicYear,
                            'graduation_date' => now()->toDateString(),
                            'graduation_note' => 'Graduated through global promotion',
                            'batch_id' => $batchId,
                            'processed_by' => auth()->id()
                        ]);

                        // Record graduation in promotion history
                        PromotionHistory::create([
                            'batch_id' => $batchId,
                            'student_id' => $student->id,
                            'from_class_id' => $currentClassId,
                            'to_class_id' => null, // Graduating
                            'previous_last_class_passed' => $student->last_class_passed,
                            'previous_graduation_status' => 'active',
                            'new_graduation_status' => 'graduated',
                            'operation_type' => 'graduate',
                            'promoted_at' => now()
                        ]);
                    }

                    // Remove students from users table (they're now in graduated_students)
                    User::where('role', 'student')
                        ->where('current_class_applying', $currentClassId)
                        ->delete();

                    $promotionResults[] = "Graduated {$studentCount} students from {$currentClass->class_name}";
                    $totalGraduating += $studentCount;
                } else {
                    // Move to next class
                    $nextClass = Classes::find($nextClassId);

                    // Record individual promotions in history
                    foreach ($students as $student) {
                        PromotionHistory::create([
                            'batch_id' => $batchId,
                            'student_id' => $student->id,
                            'from_class_id' => $currentClassId,
                            'to_class_id' => $nextClassId,
                            'previous_last_class_passed' => $student->last_class_passed,
                            'previous_graduation_status' => 'active',
                            'new_graduation_status' => 'active',
                            'operation_type' => 'promote',
                            'promoted_at' => now()
                        ]);
                    }

                    User::where('role', 'student')
                        ->where('current_class_applying', $currentClassId)
                        ->where('graduation_status', 'active')
                        ->update([
                            'current_class_applying' => $nextClassId,
                            'last_class_passed' => $currentClassId
                        ]);

                    $promotionResults[] = "Promoted {$studentCount} students from {$currentClass->class_name} to {$nextClass->class_name}";
                    $totalPromoted += $studentCount;
                }
            }

            DB::commit();

            if (empty($promotionResults)) {
                return redirect()->back()->with('error', 'No active students found to promote.');
            }

            $message = "Global Promotion Completed!\n";
            $message .= "Total Students Promoted: {$totalPromoted}\n";
            $message .= "Total Students Graduated: {$totalGraduating}\n\n";
            $message .= "Details:\n" . implode("\n", $promotionResults);

            return redirect()->back()->with('message', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Global promotion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to promote students globally. Check logs.');
        }
    }

    /**
     * Remove all graduating students (those flagged for graduation)
     */
    public function removeGraduatingStudents()
    {
        try {
            DB::beginTransaction();

            $graduatingStudents = User::where('role', 'student')
                                     ->where('graduation_status', 'graduating')
                                     ->get();

            if ($graduatingStudents->isEmpty()) {
                return redirect()->back()->with('error', 'No graduating students found.');
            }

            $graduatingCount = $graduatingStudents->count();

            // Delete related records for each graduating student
            foreach ($graduatingStudents as $student) {
                $student->subjects()->detach();
                $student->healthInfo()->delete();
                $student->parentInfo()->delete();
                $student->comments()->delete();
                $student->scores()->delete();
                $student->attendance()->delete();
                $student->teacherComment()->delete();
                $student->delete();
            }

            DB::commit();
            return redirect()->back()->with('message', "Successfully removed {$graduatingCount} graduating students from the system.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Graduating students removal failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove graduating students. Check logs.');
        }
    }

    /**
     * Demote a single student to the previous class
     */
    public function demoteStudent(Request $request, $id)
    {
        $request->validate([
            'to_class_id' => 'required|exists:classes,id',
        ]);

        try {
            DB::beginTransaction();

            $student = User::where('role', 'student')->findOrFail($id);
            $currentClassName = $student->currentClassApplying->class_name;

            $toClassId = $request->to_class_id;
            $toClassName = Classes::find($toClassId)->class_name;

            // Update student's class
            $student->update(['current_class_applying' => $toClassId]);

            DB::commit();

            return redirect()->back()->with('message',
                "Successfully moved {$student->firstname} {$student->lastname} from {$currentClassName} to {$toClassName}.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student demotion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to move student. Check logs.');
        }
    }

    /**
     * Bulk move multiple students to a different class
     */
    public function bulkMoveStudents(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:users,id',
            'to_class_id' => 'required|exists:classes,id',
        ]);

        try {
            DB::beginTransaction();

            $studentIds = $request->student_ids;
            $toClassId = $request->to_class_id;
            $toClassName = Classes::find($toClassId)->class_name;

            // Get students to move
            $students = User::where('role', 'student')
                           ->whereIn('id', $studentIds)
                           ->get();

            if ($students->isEmpty()) {
                return redirect()->back()->with('error', 'No valid students found to move.');
            }

            // Update all selected students to the new class
            User::where('role', 'student')
                ->whereIn('id', $studentIds)
                ->update([
                    'current_class_applying' => $toClassId,
                    'graduation_status' => 'active' // Reset graduation status when moving
                ]);

            DB::commit();

            $studentCount = $students->count();
            $studentNames = $students->pluck('firstname')->take(3)->implode(', ');

            if ($studentCount > 3) {
                $studentNames .= " and " . ($studentCount - 3) . " others";
            }

            return redirect()->back()->with('message',
                "Successfully moved {$studentCount} students ({$studentNames}) to {$toClassName}.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk student move failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to move students. Check logs.');
        }
    }

    /**
     * Rollback the last global promotion batch
     */
    public function rollbackLastPromotion()
    {
        try {
            DB::beginTransaction();

            // Get the latest rollbackable batch
            $latestBatch = PromotionHistory::getLatestRollbackableBatch();

            if (!$latestBatch) {
                return redirect()->back()->with('error', 'No rollbackable promotion batch found.');
            }

            $batchId = $latestBatch->batch_id;

            // Get all promotion records for this batch
            $promotionRecords = PromotionHistory::where('batch_id', $batchId)
                                               ->where('is_rolled_back', false)
                                               ->orderBy('id', 'desc') // Reverse order for rollback
                                               ->get();

            if ($promotionRecords->isEmpty()) {
                return redirect()->back()->with('error', 'No promotion records found for rollback.');
            }

            $rollbackResults = [];
            $totalRolledBack = 0;

            // Group records by class changes for efficient processing
            $classMoves = [];
            $graduationChanges = [];

            foreach ($promotionRecords as $record) {
                if ($record->to_class_id === null) {
                    // Graduation status change
                    $graduationChanges[] = $record;
                } else {
                    // Class move
                    $key = $record->from_class_id . '_to_' . $record->to_class_id;
                    if (!isset($classMoves[$key])) {
                        $classMoves[$key] = [];
                    }
                    $classMoves[$key][] = $record;
                }
            }

            // Rollback graduations (move from graduated_students back to users table)
            if (!empty($graduationChanges)) {
                $studentIds = collect($graduationChanges)->pluck('student_id')->toArray();
                $fromClassId = $graduationChanges[0]->from_class_id;

                // Get graduated students data
                $graduatedStudents = GraduatedStudent::where('batch_id', $batchId)
                                                   ->whereIn('student_id', $studentIds)
                                                   ->get();

                foreach ($graduationChanges as $record) {
                    $graduatedStudent = GraduatedStudent::where('batch_id', $batchId)
                                                       ->where('student_id', $record->student_id)
                                                       ->first();

                    if (!$graduatedStudent) continue;

                    // Check if user already exists (shouldn't happen, but safety check)
                    $existingUser = User::find($graduatedStudent->student_id);
                    if ($existingUser) {
                        // Just update the existing user to be active again
                        $existingUser->update([
                            'current_class_applying' => $fromClassId,
                            'last_class_passed' => $record->previous_last_class_passed,
                            'role' => 'student'
                        ]);
                    } else {
                        // Recreate user record with the original ID by using raw SQL with correct column names
                        DB::insert('INSERT INTO users (id, firstname, lastname, email, sex, date_of_birth, phone, residential_address, passport, current_class_applying, last_class_passed, role, username, password, place_of_birth, blood_group, genotype, local_govt_origin, religion, nationality, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                            $graduatedStudent->student_id,
                            $graduatedStudent->firstname,
                            $graduatedStudent->lastname,
                            $graduatedStudent->email,
                            $graduatedStudent->sex,
                            $graduatedStudent->date_of_birth,
                            $graduatedStudent->phone_number ?: 'N/A',
                            $graduatedStudent->address ?: 'Unknown Address',
                            $graduatedStudent->profile_pic,
                            $fromClassId,
                            $record->previous_last_class_passed,
                            'student',
                            $graduatedStudent->email ?: 'student_' . $graduatedStudent->student_id,
                            bcrypt('default123'),
                            'Unknown', // place_of_birth
                            'Unknown', // blood_group
                            'Unknown', // genotype
                            'Unknown', // local_govt_origin
                            'Unknown', // religion
                            'Nigerian', // nationality
                            '1', // is_active
                            now(),
                            now()
                        ]);
                    }
                }

                // Remove from graduated_students table
                GraduatedStudent::where('batch_id', $batchId)
                               ->whereIn('student_id', $studentIds)
                               ->delete();

                $fromClass = Classes::find($fromClassId);
                $graduationCount = count($graduationChanges);
                $rollbackResults[] = "Restored {$graduationCount} students from graduated_students back to {$fromClass->class_name}";
                $totalRolledBack += $graduationCount;
            }

            // Fallback: Handle graduated students if no graduation promotion history exists
            if (empty($graduationChanges)) {
                $graduatedStudentsInBatch = GraduatedStudent::where('batch_id', $batchId)->get();

                if ($graduatedStudentsInBatch->count() > 0) {
                    foreach ($graduatedStudentsInBatch as $graduatedStudent) {
                        // Check if user already exists
                        $existingUser = User::find($graduatedStudent->student_id);
                        if ($existingUser) {
                            // Just update the existing user to be in their original class
                            $existingUser->update([
                                'current_class_applying' => $graduatedStudent->graduated_from_class_id,
                                'last_class_passed' => null, // We don't have previous value in fallback case
                                'role' => 'student'
                            ]);
                        } else {
                            // Recreate user record with the original ID
                            DB::insert('INSERT INTO users (id, firstname, lastname, email, sex, date_of_birth, phone, residential_address, passport, current_class_applying, last_class_passed, role, username, password, place_of_birth, blood_group, genotype, local_govt_origin, religion, nationality, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                                $graduatedStudent->student_id,
                                $graduatedStudent->firstname,
                                $graduatedStudent->lastname,
                                $graduatedStudent->email,
                                $graduatedStudent->sex,
                                $graduatedStudent->date_of_birth,
                                $graduatedStudent->phone_number ?: 'N/A',
                                $graduatedStudent->address ?: 'Unknown Address',
                                $graduatedStudent->profile_pic,
                                $graduatedStudent->graduated_from_class_id, // Original class
                                null, // last_class_passed - we don't have previous value in fallback case
                                'student',
                                $graduatedStudent->email ?: 'student_' . $graduatedStudent->student_id,
                                bcrypt('default123'),
                                'Unknown', // place_of_birth
                                'Unknown', // blood_group
                                'Unknown', // genotype
                                'Unknown', // local_govt_origin
                                'Unknown', // religion
                                'Nigerian', // nationality
                                '1', // is_active
                                now(),
                                now()
                            ]);
                        }
                    }

                    // Remove from graduated_students table
                    GraduatedStudent::where('batch_id', $batchId)->delete();

                    $graduatedClass = Classes::find($graduatedStudentsInBatch->first()->graduated_from_class_id);
                    $graduationCount = $graduatedStudentsInBatch->count();
                    $rollbackResults[] = "Restored {$graduationCount} graduated students back to {$graduatedClass->class_name}";
                    $totalRolledBack += $graduationCount;
                }
            }

            // Rollback class moves
            foreach ($classMoves as $moveKey => $records) {
                $fromClassId = $records[0]->from_class_id;
                $toClassId = $records[0]->to_class_id;

                // Get individual records to restore previous last_class_passed values
                foreach ($records as $record) {
                    User::where('id', $record->student_id)
                        ->update([
                            'current_class_applying' => $fromClassId,
                            'last_class_passed' => $record->previous_last_class_passed,
                            'graduation_status' => 'active'
                        ]);
                }

                $fromClass = Classes::find($fromClassId);
                $toClass = Classes::find($toClassId);
                $studentCount = count($records);

                $rollbackResults[] = "Moved {$studentCount} students back from {$toClass->class_name} to {$fromClass->class_name}";
                $totalRolledBack += $studentCount;
            }

            // Mark all records as rolled back
            PromotionHistory::where('batch_id', $batchId)
                           ->update([
                               'is_rolled_back' => true
                           ]);

            DB::commit();

            $message = "Promotion Rollback Completed!\n";
            $message .= "Batch ID: {$batchId}\n";
            $message .= "Total Students Restored: {$totalRolledBack}\n\n";
            $message .= "Details:\n" . implode("\n", $rollbackResults);

            return redirect()->back()->with('message', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Promotion rollback failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to rollback promotion. Check logs.');
        }
    }


}
