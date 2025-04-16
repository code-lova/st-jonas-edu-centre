<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){

        $teacherId = auth()->id();
        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $data['title'] = "Profile Settings Dashboard";
        $data['currentTermSession'] =$currentTermSession;
        $data['profile'] = User::where('id', $teacherId)->where('role', 'teacher')->first();

        return view('dashboards.teacher.profile', $data);
    }



    public function changePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $id = auth()->id();

        try {

            DB::beginTransaction(); // Start transaction

            // Find the user
            $user = User::where('id', $id)->firstOrFail();

            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect!');
            }
            $user->password = Hash::make($request->new_password);

            $user->save();

            DB::commit(); // Commit transaction

            return redirect()->back()->with('message', 'Password changed successfully!!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if any error occurs
            Log::error('Password update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update password. Check logs.');
        }
    }



}
