<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermController extends Controller
{
    public function index(){
        $data['title'] = "List of Academic Term";
        $data['term'] = Term::latest()->get();
        $data['sessions'] = Session::all();
        return view('dashboards.admin.term.index', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30|unique:terms,name',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'session_id' => 'integer',
        ], [
            'name.required' => 'The term name is required.',
            'name.string' => 'The term name must be a valid string.',
            'name.max' => 'The term name must not exceed 30 characters.',
            'name.unique' => 'This term name already exists.',

            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.before_or_equal' => 'The start date must be before or equal to the end date.',

            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',

            'session_id' => 'Session Id must be an integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        // Create and save the term
        $term = new Term();
        $term->name = $request->input('name');
        $term->start_date = $request->input('start_date');
        $term->end_date = $request->input('end_date');
        $term->session_id = $request->input('session_id');
        $term->save();

        return redirect()->back()->with('message', 'Term created successfully!');
    }



    public function destroy($id)
    {
        $class = Term::findOrFail($id);
        $class->delete();

        return response()->json(['message' => 'Term deleted successfully!']);
    }




}
