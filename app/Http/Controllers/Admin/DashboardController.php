<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = "Admin Dashboard";
        $terms = $data['term'] = Term::all();
        $data['noTermActive'] = $terms->count() > 0 && $terms->every(fn ($term) => $term->status == 0);
        $data['sessions'] = Session::all();
        $data['numOfStaff'] = User::where('role', 'teacher')->count();
        $data['numOfStudent'] = User::where('role', 'student')->count();
        $data['user'] = User::where('id', Auth::user()->id)->first();
        return view('dashboards.admin.index', $data);
    }


    public function activateTerm($id){
        $data = Term::all();
        foreach ($data as $datas){
            $datas->status = 0;
            $datas->save();
        }
        $default = Term::find($id);
        if($default){
            $default->status = 1;
            $default->save();
            return redirect()->back()->with('message','This Term has been Set to Default');
        }
        else{
            return redirect()->back()->with('error','Term ID Not Found');
        }
    }
}
