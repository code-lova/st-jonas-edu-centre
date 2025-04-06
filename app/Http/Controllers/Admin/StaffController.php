<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\TeacherSubjects;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

class StaffController extends Controller
{

    public function index(){
        $data['title'] = "List of Staff";
        $data['staffs'] = User::where('role', 'teacher')->with(['subjects' => function ($query) {
            $query->with('class');
        }])->latest()->get();
        return view('dashboards.admin.staff.index', $data);
    }

    public function create(){
        $data['title'] = "Create New Staff";
        $data['availableSubjects'] = Subject::all();
        // Get assigned subjects (i.e., subjects that have been taken by teachers)
        $data['assignedSubjects'] = TeacherSubjects::pluck('subject_id')->toArray();
        $data['classes'] = Classes::all();
        return view('dashboards.admin.staff.create', $data);
    }

    public function store(StoreStaffRequest $request){
        try {
            DB::beginTransaction(); // Start transaction

            // Create new student user
            $user = User::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email'=> $request->email,
                'phone' => $request->phone,
                'whatsApp_contact' => $request->whatsApp_contact,
                'password' => Hash::make($request->password),
                'role' => 'teacher',
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'class_teacher' => $request->class_teacher,
                'place_of_birth' => $request->place_of_birth,
                'blood_group' => $request->blood_group,
                'genotype' => $request->genotype,
                'residential_address' => $request->residential_address,
                'local_govt_origin' => $request->local_govt_origin,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
            ]);


            // Assign selected subjects to the teacher
            if ($request->has('subject_id')) {
                foreach ($request->subject_id as $subjectId) {
                    $subject = Subject::find($subjectId);
                    if ($subject) {
                        TeacherSubjects::create([
                            'user_id' => $user->id,
                            'subject_id' => $subject->id,
                            'class_id' => $subject->class_id, // Get class_id from subject model
                        ]);
                    }else{
                        return redirect()->back()->with('error', 'Subject id does not exist');
                    }
                }
            }

            DB::commit(); // Commit transaction

            return redirect()->route('staff.list')->with('message', 'Staff registration successful!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if any error occurs
            Log::error('Student registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to register Staff. Check logs.');
        }
    }

    public function edit($id){
        $data['title'] = "Staff Information";
        $data['user'] = User::with(['subjects' => function ($query) {
            $query->with('class');
        }])->where('id', $id)->firstOrFail();
        return view('dashboards.admin.staff.edit', $data);
    }


    public function update($id){
        $data['title'] = "Update Staff Information";
        $data['user'] = User::with(['subjects' => function ($query) {
            $query->with('class');
        }])->where('id', $id)->firstOrFail();

            // Get the currently assigned class of the staff being edited
        $currentStaffClass = $data['user']->class_teacher;

        // Get all class IDs that are already assigned to other staff
        $assignedClassIds = User::whereNotNull('class_teacher')
                                ->where('id', '!=', $id)
                                ->pluck('class_teacher')
                                ->toArray();

        // Fetch classes that are either not assigned to anyone OR assigned to the current staff
        $data['classes'] = Classes::whereNotIn('id', $assignedClassIds)
                              ->orWhere('id', $currentStaffClass)
                              ->get();

        $data['availableSubjects'] = Subject::all();

         // Get all assigned subjects (i.e., subjects that are already taken by other teachers)
        $data['assignedSubjects'] = TeacherSubjects::where('user_id', '!=', $id)->pluck('subject_id')->toArray();

        // Get subjects assigned to the staff being edited
        $data['staffSubjects'] = $data['user']->subjects->pluck('id')->toArray();

        return view('dashboards.admin.staff.update', $data);
    }


    public function updateStaff(UpdateStaffRequest $request, $id){
        try {
            DB::beginTransaction(); // Start transaction

            // Find the Staff
            $user = User::where('id', $id)->firstOrFail();

            // Update Staff details
            $user->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email'=> $request->email,
                'phone' => $request->phone,
                'whatsApp_contact' => $request->whatsApp_contact,
                'role' => 'teacher',
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'class_teacher' => $request->class_teacher,
                'place_of_birth' => $request->place_of_birth,
                'blood_group' => $request->blood_group,
                'genotype' => $request->genotype,
                'residential_address' => $request->residential_address,
                'local_govt_origin' => $request->local_govt_origin,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
            ]);

            // Update password only if provided
            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            // Remove old subject assignments before updating
            TeacherSubjects::where('user_id', $user->id)->delete();


            // Assign selected subjects to the teacher
            if ($request->has('subject_id')) {
                foreach ($request->subject_id as $subjectId) {
                    $subject = Subject::find($subjectId);
                    if ($subject) {
                        TeacherSubjects::updateOrCreate([
                            'user_id' => $user->id,
                            'subject_id' => $subject->id,
                            'class_id' => $subject->class_id, // Get class_id from subject model
                        ]);
                    }else{
                        return redirect()->back()->with('error', 'Subject id does not exist');
                    }
                }
            }

            DB::commit(); // Commit transaction

            return redirect()->route('staff.list')->with('message', 'Staff information updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if any error occurs
            Log::error('Student update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update Staff. Check logs.');
        }
    }



    public function destroy($id)
    {
        try {
            DB::beginTransaction(); // Start transaction

            $user = User::findOrFail($id);

            // Ensure the user is a staff (optional: customize based on role column if applicable)
            if ($user->role !== 'teacher') {
                return redirect()->back()->with('error', 'Only staff members can be deleted.');
            }

            // Delete related records (example: TeacherSubjects, if applicable)
            $user->subjects()->detach(); // If there's a many-to-many relationship

            // Delete user record
            $user->delete();

            DB::commit(); // Commit transaction

            return redirect()->back()->with('message', 'Staff deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs
            Log::error('Staff deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete staff. Check logs.');
        }
    }
}
