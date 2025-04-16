<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Teacher Dashboard";
        $now = Carbon::now();
        $greeting = match (true) {
            $now->hour < 12 => 'Good morning',
            $now->hour < 17 => 'Good afternoon',
            default => 'Good evening',
        };
        $currentTermSession = Term::with('session')->where('status', '1')->first();

        $data['greeting'] = $greeting;
        $data['currentDateTime'] = $now->format('l, F j, Y - g:i A');
        $data['currentTermSession'] =$currentTermSession;
        return view('dashboards.teacher.index', $data);
    }
}
