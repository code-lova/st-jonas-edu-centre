<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Student Dashboard";
        $now = Carbon::now();
        $greeting = match (true) {
            $now->hour < 12 => 'Good morning',
            $now->hour < 17 => 'Good afternoon',
            default => 'Good evening',
        };

        $data['greeting'] = $greeting;
        return view('dashboards.student.index', $data);
    }
}
