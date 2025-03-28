<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Admin Dashboard";
        $data['user'] = User::where('id', Auth::user()->id)->first();
        return view('dashboards.admin.index', $data);
    }
}
