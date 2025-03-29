<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function create(){
        $data['title'] = "Create New Staff";
        return view('dashboards.admin.staff.create', $data);
    }
}
