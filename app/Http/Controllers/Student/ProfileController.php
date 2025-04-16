<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){

        $studentId = Auth::user();
        $studentDetails = User::where('id', $studentId->id)->first();

        $data['title'] = "My Profile Details";

        $data['studentDetails'] = $studentDetails;
        return view('dashboards.student.profile', $data);
    }

    public function studentFees(){

        $data['title'] = "My school Fees";

        return view('dashboards.student.fees', $data);
    }



}
