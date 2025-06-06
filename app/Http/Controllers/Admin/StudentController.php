<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classes;
use App\Models\Healthinfo;
use App\Models\ParentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Settings;
use App\Models\Term;

class StudentController extends Controller
{

    public function index(){
        $currentTermSession = Term::with('session')->where('status', '1')->first();
        $data['title'] = "List of all Student";
        $data['currentTermSession'] = $currentTermSession;
        $data['settings'] = Settings::find(1);
        $data['students'] = User::where('role', 'student')->latest()->get();
        $data['classes'] = Classes::all();
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
        $data['user'] = User::with(['healthInfo', 'parentInfo'])->where('id', $id)->firstOrFail();
        return view('dashboards.admin.student.edit', $data);
    }

    public function update($id){
        $data['title'] = "Update Student Information";
        $data['classes'] = Classes::all();
        $data['user'] = User::with(['healthInfo', 'parentInfo'])->where('id', $id)->firstOrFail();
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



}
