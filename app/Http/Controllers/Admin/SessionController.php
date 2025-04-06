<?php

namespace App\Http\Controllers\Admin;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function index(){
        $data['title'] = "List of Academic Sessions";
        $data['sessions'] = Session::latest()->get();
        return view('dashboards.admin.session.index', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30|unique:sessions,name',
        ], [
            'name.required' => 'Academic Session is required',
            'name.max' => 'The session name must not be more than 30 characters.',
            'name.unique' => 'Academic session name already exists.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Create and save the class
        $session = new Session();
        $session->name = $request->input('name');
        $session->save();

        return redirect()->back()->with('message', 'Session created successfully!');
    }



    public function destroy($id)
    {
        $class = Session::findOrFail($id);
        $class->delete();

        return response()->json(['message' => 'Session deleted successfully!']);
    }
}
