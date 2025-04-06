<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use App\Models\User;
use App\Models\Classes;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\PrincipalComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PrincipalCommentController extends Controller
{
    public function index(){
        $data['title'] = "Custom comment dashboard";
        $data['sessions'] = Session::all();
        $data['terms'] = Term::all();
        $data['classes'] = Classes::all();
        $data['comments'] = PrincipalComment::all();
        return view('dashboards.admin.comments.index', $data);
    }

    public function getStudentsByClass(Request $request)
    {
        $classId = $request->class_id;

        $students = User::where('role', 'student')
            ->where('current_class_applying', $classId)
            ->get(['id', 'firstname', 'lastname']);

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id',
            'term_id' => 'required|exists:terms,id',
            'class_id' => 'required|exists:classes,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|max:1000',
        ], [
            'session_id.required' => 'Academic session is required.',
            'term_id.required' => 'Academic term is required.',
            'class_id.required' => 'The student class is required.',
            'user_id.required' => 'User ID is required.',
            'comment.required' => 'Comment cannot be empty.',
            'comment.max' => 'Comment must not exceed 1000 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        // Check if the user already has 2 comments for the same session, term, and class
        $existingCommentCount = PrincipalComment::where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->where('class_id', $request->class_id)
            ->where('user_id', $request->user_id)
            ->count();

        if ($existingCommentCount >= 1) {
            return redirect()->back()->with('error', 'User already has a comments for this term.');
        }

        // Create and save the comment
        PrincipalComment::create([
            'session_id' => $request->session_id,
            'term_id' => $request->term_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('message', 'Comment saved successfully!');
    }



    public function destroy($id)
    {
        $class = PrincipalComment::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully!');
    }

}
