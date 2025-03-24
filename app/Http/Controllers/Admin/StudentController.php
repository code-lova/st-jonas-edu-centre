<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Healthinfo;
use App\Models\ParentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{

    public function index(){
        $data['title'] = "List of all Student";
        $data['students'] = User::where('role', 'student')->latest()->get();
        return view('dashboards.admin.student.index', $data);
    }


    public function create(){
        $data['title'] = "Create New Student";
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

            return redirect()->back()->with('message', 'Student registered successfully!');

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
        $data['user'] = User::with(['healthInfo', 'parentInfo'])->where('id', $id)->firstOrFail();
        return view('dashboards.admin.student.update', $data);
    }


}
