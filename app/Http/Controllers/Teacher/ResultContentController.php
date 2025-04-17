<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\ResultContent;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResultContentController extends Controller
{
    public function index(){

        $teacher = Auth::user();

        $classTeacherClass = null;
        $isClassTeacher = false;

        $currentTermSession = Term::with('session')->where('status', '1')->first();


        if (!is_null($teacher->class_teacher)) {
            // Get the class that the logged in user is assigned a class teacher
            $classTeacherClass = Classes::find($teacher->class_teacher);
            $isClassTeacher = $classTeacherClass !== null;
        }

        $data['title'] = "Result Content";
        $data['settings'] = Settings::find(1);
        $data['resultContent'] = ResultContent::find(1);
        $data['auth'] = $teacher;
        $data['classTeacherClass'] = $classTeacherClass;
        $data['isClassTeacher'] = $isClassTeacher;
        $data['currentTermSession'] =$currentTermSession;

        return view('dashboards.teacher.result-content', $data);
    }

    public function saveSettings(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'school_open' => 'required|max:255',
            'number_in_class' => 'string',
            'term_ends' => 'required|string',
            'term_begins'=>'required',
            'class_teacher_name' => 'required',
            'directors_name' => 'required|string',
            'class_id' => 'required|exists:classes,id',
        ]);

        if($validator->fails())
        {
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', $validator->errors()->first());
            }
        }

        $settings = ResultContent::where('id', '1')->first();
        if($settings)
        {
            $settings->school_open = $request->school_open;
            $settings->number_in_class = $request->number_in_class;
            $settings->term_ends = $request->term_ends;
            $settings->term_begins = $request->term_begins;
            $settings->class_teacher_name = $request->class_teacher_name;
            $settings->directors_name = $request->directors_name;
            $settings->class_id = $request->class_id;
            $settings->save();
            return redirect()->back()->with('message','Settings Updated Successfully');
        }
        else
        {
            $settings = new ResultContent;
            $settings->school_open = $request->school_open;
            $settings->number_in_class = $request->number_in_class;
            $settings->term_ends = $request->term_ends;
            $settings->term_begins = $request->term_begins;
            $settings->class_teacher_name = $request->class_teacher_name;
            $settings->directors_name = $request->directors_name;
            $settings->class_id = $request->class_id;
            $settings->save();
            return redirect()->back()->with('message','Settings Added Successfully');
        }
    }


}
