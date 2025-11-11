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
    Route::get('/activate-term/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'activateTerm']);


    Route::controller(\App\Http\Controllers\Admin\StudentController::class)->group(function() {
        Route::get('/student-list', 'index')->name('studentlist');
        Route::get('/register-student', 'create')->name('newstudent');
        Route::post('/register-student', 'store')->name('students.store');
        Route::get('/student-detail/{id}', 'edit')->name('viewstudent');
        Route::get('/update-student/{id}', 'update')->name('updatestudent');
        Route::put('/update-student/{id}', 'updateStudent');
        Route::delete('/delete-student/{id}', 'destroy')->name('student.delete');

        // Class promotion routes
        Route::post('/promote-all-students', 'promoteAllStudents')->name('students.promote.all');
        Route::post('/rollback-last-promotion', 'rollbackLastPromotion')->name('students.rollback.promotion');
        Route::post('/demote-student/{id}', 'demoteStudent')->name('student.demote');
        Route::post('/bulk-move-students', 'bulkMoveStudents')->name('students.bulk.move');
        Route::delete('/remove-graduating-students', 'removeGraduatingStudents')->name('students.remove.graduating');
    });

    // Graduated Students routes
    Route::controller(\App\Http\Controllers\Admin\GraduatedStudentController::class)->group(function() {
        Route::get('/graduated-students', 'index')->name('graduated-students.index');
        Route::get('/graduated-students/{id}', 'show')->name('graduated-students.show');
        Route::get('/graduated-students-export', 'export')->name('graduated-students.export');
        Route::get('/graduation-stats', 'getStats')->name('graduation.stats');

        //Route::get('/filter-students-by-class/{classId}','filterByClass');



    });

    Route::controller(\App\Http\Controllers\Admin\StaffController::class)->group(function (){
        Route::get('/staff-list', 'index')->name('staff.list');
        Route::get('/register-staff', 'create')->name('newstaff');
        Route::post('/register-staff', 'store')->name('staff.store');
        Route::get('/staff-detail/{id}', 'edit')->name('view.staff');
        Route::get('/update-staff/{id}', 'update')->name('update.staff');
        Route::put('/update-staff/{id}', 'updateStaff');
        Route::delete('/delete-staff/{id}', 'destroy')->name('staff.delete');

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


    Route::controller(\App\Http\Controllers\Admin\SessionController::class)->group(function () {
        Route::get('/session', 'index')->name('sessionlist');
        Route::post('/session', 'store')->name('create.session');
        Route::delete('/session/delete/{id}', 'destroy');

    });

    Route::controller(\App\Http\Controllers\Admin\TermController::class)->group(function () {
        Route::get('/term', 'index')->name('termlist');
        Route::post('/term', 'store')->name('create.term');
        Route::post('/term/update', 'update')->name('update.term');
        Route::delete('/term/delete/{id}', 'destroy');

    });

    Route::controller(\App\Http\Controllers\Admin\PrincipalCommentController::class)->group(function () {
        Route::get('/comment', 'index')->name('commentlist');
        Route::get('/students-by-class', 'getStudentsByClass')->name('admin.students.by.class');
        Route::post('/comment', 'store')->name('create.comment');
        Route::delete('/delete-comment/{id}', 'destroy');

    });


    Route::controller(\App\Http\Controllers\Admin\SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::post('/settings', 'store')->name('settings.store');

    });

});


//Group Route for Teacher Profile
Route::prefix('teacher')->middleware(['auth', 'isTeacher'])->group(function (){

    Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');

    Route::controller(\App\Http\Controllers\Teacher\ScoreController::class)->group(function () {
        Route::get('/enter-score', 'create')->name('enterscore');


        // Handle session and term selection, redirect to subject-class view
        Route::post('/select-session-term', 'handleSessionTermSelection')->name('teacher.handle.session_term');
        // Redirect the user if they send a GET request to the route
        Route::get('select-session-term', function () {
            return redirect()->route('enterscore')->with('error', 'Please use the form to manage scores.');
        });


         // Display score input form for a class-subject combo
        Route::post('/manage-scores', 'showScoreForm')->name('teacher.manage_scores');
        // Redirect the user if they send a GET request to the route
        Route::get('/manage-scores', function () {
            return redirect()->route('teacher.dashboard')->with('error', 'Please use the form to manage scores.');
        });

        // Handle score updates (optional POST/PUT route)
        Route::post('/save-scores', 'saveScores')->name('teacher.save_scores');

    });

    Route::controller(\App\Http\Controllers\Teacher\TeacherCommentController::class)->group(function (){
        Route::get('/comment', 'index')->name('comment.list');

        Route::get('/students-by-class', 'getStudentsByClass')->name('students.by.class');

        Route::post('/comment', 'store')->name('create.teacher.comment');

        Route::get('/profile', 'profilePage')->name('my.profile');

        Route::delete('/delete-comment/{id}', 'destroy');

    });


    Route::controller(\App\Http\Controllers\Teacher\ProfileController::class)->group(function (){

        Route::get('/profile', 'index')->name('my.profile');

        Route::post('/change-password', 'changePassword')->name('profile.change_password');

    });

    Route::controller(\App\Http\Controllers\Teacher\ResultContentController::class)->group(function (){

        Route::get('/result-content', 'index')->name('result.content');

        Route::post('/result-content', 'saveSettings')->name('save.result.content');

    });


    Route::controller(\App\Http\Controllers\Teacher\AttendanceController::class)->group(function (){

        Route::get('/attendance', 'index')->name('attendance');

        Route::post('/attendance', 'store')->name('attendance.store');

        Route::get('/attendance/fetch', 'fetchAttendance')->name('attendance.fetch');
    });




});


//Group Route for Student Profile
Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function (){

    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index']);

    Route::controller(\App\Http\Controllers\Student\ResultController::class)->group(function (){

        Route::get('/result',  'index')->name('result');

        Route::post('/result', 'getStudentResult')->name('view.result');
    });



    Route::get('/profile', [\App\Http\Controllers\Student\ProfileController::class, 'index'])->name('profile');

    Route::get('/student-fees', [\App\Http\Controllers\Student\ProfileController::class, 'studentFees'])->name('fees');

    Route::get('/holiday-homework', [\App\Http\Controllers\Student\ProfileController::class, 'index'])->name('holiday.assignments');



});
