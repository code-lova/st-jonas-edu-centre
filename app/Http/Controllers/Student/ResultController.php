<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(){
        $data['title'] = "My Result Sheet";
        return view('dashboards.student.result', $data);
    }
}
