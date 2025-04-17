<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $username = $user->username;
        $data['title'] = "Application Settings Area";
        $data['settings'] = Settings::find(1);
        $data['username'] = $username;
        return view('dashboards.admin.settings.index', $data);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'site_name' => 'required|max:255',
            'title' => 'required|string',
            'email' => 'required|email',
            'site_description'=>'required|string',
            'mobile' => 'required',
            'keywords' => 'required|string',
            'address' => 'required',
            'directors_name' => 'required',
            'principal_name' => 'required',
            'school_open' => 'required',
            'term_ends' => 'required',
            'term_begins' => 'required',
            'next_term_resumption_date' => 'required',
            'open_result' => 'required|in:0,1',
            'principal_signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required',
            'password' => 'nullable|string|min:6|confirmed',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $settings = Settings::where('id', '1')->first();
        if($settings)
        {
            $settings->site_name = $request->site_name;
            $settings->title = $request->title;
            $settings->email = $request->email;
            $settings->keywords = $request->keywords;
            $settings->mobile = $request->mobile;
            $settings->site_description = $request->site_description;
            $settings->address = $request->address;
            $settings->directors_name = $request->directors_name;
            $settings->principal_name = $request->principal_name;
            $settings->school_open = $request->school_open;
            $settings->term_ends = $request->term_ends;
            $settings->term_begins = $request->term_begins;
            $settings->next_term_resumption_date = $request->next_term_resumption_date;
            $settings->open_result = $request->open_result == true ? '1':'0';

            if($request->hasFile('principal_signature'))
            {
                $destination_path = 'uploads/'.$settings->principal_signature;
                if(File::exists($destination_path))
                {
                    File::delete($destination_path);
                }

                $file = $request->file('principal_signature');
                $filename = 'principal_signature_'. time() . '.' . $file->hashName();
                $file->move('uploads/', $filename);
                $settings->principal_signature = $filename;

            }

            if($request->hasFile('site_logo'))
            {
                $destination_path = 'uploads/'.$settings->site_logo;
                if(File::exists($destination_path)){
                    File::delete($destination_path);
                }
                $file = $request->file('site_logo');
                $filename = 'site_logo_'. time() . '.' . $file->hashName();
                $file->move('uploads/', $filename);
                $settings->site_logo = $filename;

            }
            $settings->save();

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->username = $request->username;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with('message','Settings Updated Successfully');
        }
        else
        {
            $settings = new Settings;
            $settings->site_name = $request->site_name;
            $settings->title = $request->title;
            $settings->email = $request->email;
            $settings->keywords = $request->keywords;
            $settings->mobile = $request->mobile;
            $settings->site_description = $request->site_description;
            $settings->address = $request->address;
            $settings->directors_name = $request->directors_name;
            $settings->principal_name = $request->principal_name;
            $settings->school_open = $request->school_open;
            $settings->term_ends = $request->term_ends;
            $settings->term_begins = $request->term_begins;
            $settings->next_term_resumption_date = $request->next_term_resumption_date;

            if($request->hasFile('principal_signature'))
            {
                $file = $request->file('principal_signature');
                $filename = 'principal_signature_' . time() . '.' . $file->hashName();
                $file->move('uploads/', $filename);
                $settings->principal_signature = $filename;
            }

            if($request->hasFile('site_logo'))
            {
                $file = $request->file('site_logo');
                $filename = 'site_logo_' . time() . '.' . $file->hashName();
                $file->move('uploads/', $filename);
                $settings->site_logo = $filename;
            }

            $settings->save();

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->username = $request->username;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with('message','Settings Added Successfully');
        }

    }



}
