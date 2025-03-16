<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        $data['title'] = "St. Jonas Educational Center";
        return view('homepages.index', $data);
    }

    public function History(){
        $data['title'] = "Our History";
        return view('homepages.history', $data);
    }

    public function portalPage(){
        $data['title'] = "School Portal";
        return view('homepages.portal', $data);
    }


    public function FaqPage(){
        $data['title'] = "FAQ";
        return view('homepages.faq', $data);
    }


    public function galleryPage(){
        $data['title'] = "Our Gallery";
        return view('homepages.gallery', $data);
    }


    public function onlineLearning(){
        $data['title'] = "Online Learning";
        return view('homepages.online-learning', $data);
    }


    public function curriculumPage(){
        $data['title'] = "Our Curriculum";
        return view('homepages.our-curriculum', $data);
    }


    public function privacyPolicy(){
        $data['title'] = "Privacy Policy";
        return view('homepages.privacy-policy', $data);
    }


    public function anthemPage(){
        $data['title'] = "School Anthem";
        return view('homepages.school-anthem', $data);
    }


    public function staffManagement(){
        $data['title'] = "Staff and Management";
        return view('homepages.staff-management', $data);
    }


    public function vision(){
        $data['title'] = "Our Vision and Mission";
        return view('homepages.vision-mission', $data);
    }


    public function whyUs(){
        $data['title'] = "Why St Jonas Education Centre";
        return view('homepages.whyUs', $data);
    }

    public function teachersLogin(){
        $data['title'] = "Teachers Portal";
        return view('auth.teacherlogin', $data);
    }

    public function studentsLogin(){
        $data['title'] = "Student Portal";
        return view('auth.studentlogin', $data);
    }




}
