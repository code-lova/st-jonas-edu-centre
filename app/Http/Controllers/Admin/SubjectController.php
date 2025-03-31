<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(){
        $data['title'] = "Subject Dashboard";
        $data['subject'] = Subject::latest()->paginate(10);
        $data['classes'] = Classes::all();
        return view('dashboards.admin.subject.index', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'subject_name' => [
            'required',
            'max:30',
                Rule::unique('subjects')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            'class_id' => 'required|integer|exists:classes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        // Create and save the class
        $subject = new Subject();
        $subject->subject_name = $request->subject_name;
        $subject->class_id = $request->class_id;
        $subject->save();

        return redirect()->back()->with('message', 'Subject created successfully!');
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject_name' => [
            'required',
            'max:30',
                Rule::unique('subjects')->where(function ($query) use ($request, $id) {
                    return $query->where('class_id', $request->class_id)
                                ->where('id', '!=', $id); // Exclude the current subject
                }),
            ],
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Find and update the class
        $subject = Subject::findOrFail($id);
        $subject->subject_name = $request->subject_name;
        $subject->class_id = $request->class_id;
        $subject->save();

        return response()->json(['message' => 'Subject updated successfully!']);
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully!']);
    }
}
