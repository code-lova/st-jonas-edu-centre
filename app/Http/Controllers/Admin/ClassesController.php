<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ClassesController extends Controller
{
    public function index(){
        $data['title'] = "Create Dashboard";
        $data['classes'] = Classes::latest()->get();
        return view('dashboards.admin.classes.index', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|max:10|unique:classes,class_name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first()); // Send only the first error message
        }

        // Create and save the class
        $class = new Classes();
        $class->class_name = $request->input('class_name');
        $class->save();

        return redirect()->back()->with('message', 'Class created successfully!');
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|max:10|unique:classes,class_name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Find and update the class
        $class = Classes::findOrFail($id);
        $class->class_name = $request->input('class_name');
        $class->save();

        return response()->json(['message' => 'Class updated successfully!']);
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return response()->json(['message' => 'Class deleted successfully!']);
    }


}
