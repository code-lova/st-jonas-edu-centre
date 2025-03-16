<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Teacher Dashboard";
        return view('dashboards.teacher.index', $data);
    }
}
