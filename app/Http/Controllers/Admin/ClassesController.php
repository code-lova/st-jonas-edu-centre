<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(){
        $data['title'] = "Create New Class";
        return view('dashboards.admin.classes.index', $data);
    }
}
