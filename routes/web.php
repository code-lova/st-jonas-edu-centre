<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});

Auth::routes();

Route::controller(\App\Http\Controllers\Frontend\HomepageController::class)->group(function (){
    Route::get('/', 'index')->name('home');
    Route::get('/hostory', 'History')->name('history');
    Route::get('/faq', 'FaqPage')->name('faq');
    Route::get('/gallery', 'galleryPage')->name('gallery');
    Route::get('/portal', 'portalPage')->name('portal');
    Route::get('/online-learning', 'onlineLearning')->name('learning');
    Route::get('/our-curriculum', 'curriculumPage')->name('curriculum');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy');
    Route::get('/school-anthem', 'anthemPage')->name('anthem');
    Route::get('/staff-management', 'staffManagement')->name('management');
    Route::get('/vision-mission', 'vision')->name('vision');
    Route::get('/why-st-jonas', 'whyUs')->name('whyus');
    Route::get('/teachers-portal', 'teachersLogin')->name('teacher');
    Route::get('/students-portal', 'studentsLogin')->name('student');

});



//Group Route for Admin Profile
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::controller(\App\Http\Controllers\Admin\StudentController::class)->group(function() {
        Route::get('/student-list', 'index')->name('studentlist');
        Route::get('/register-student', 'create')->name('newstudent');
        Route::post('/register-student', 'store')->name('students.store');
        Route::get('/student-detail/{id}', 'edit')->name('viewstudent');
        Route::get('/update-student/{id}', 'update')->name('updatestudent');
        Route::put('/update-student/{id}', 'updateStudent');
    });

    Route::controller(\App\Http\Controllers\Admin\StaffController::class)->group(function (){
        Route::get('/register-staff', 'create')->name('newstaff');
        Route::post('/register-staff', 'store')->name('staff.store');


    });

    Route::controller(\App\Http\Controllers\Admin\ClassesController::class)->group(function() {
        Route::get('/class', 'index')->name('classlist');
        Route::post('/class', 'store')->name('create.class');
        Route::put('/class/update/{id}', 'update')->name('update.class');
        Route::delete('/class/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\SubjectController::class)->group(function() {
        Route::get('/subject', 'index')->name('subjectlist');
        Route::post('/subject', 'store')->name('create.subject');
        Route::put('/subject/update/{id}', 'update')->name('update.subject');
        Route::delete('/subject/delete/{id}', 'destroy');
    });




});


//Group Route for Teacher Profile
Route::prefix('teacher')->middleware(['auth', 'isTeacher'])->group(function (){

    Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index']);

});


//Group Route for Student Profile
Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function (){

    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index']);

});
