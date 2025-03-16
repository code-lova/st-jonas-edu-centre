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
        Route::get('/register-student', 'registerNewStudent')->name('newstudent');
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
