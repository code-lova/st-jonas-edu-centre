<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $data['title'] = "Application Settings Area";

        return view('dashboards.admin.settings.index', $data);
    }

}
