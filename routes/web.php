<?php

use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontend\TeacherController as FrontendTeacherController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\ClassModel;
use App\Models\StudentAttendanceModel;
use App\Models\User;
use Illuminate\Support\Facades\Route;


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
Route::get('/', function(){
    return Inertia::render('Home');
});
Route::get('/about', function(){
    return Inertia::render('About');
});
Route::get('/attendance', function(){

    $students    = User::all();
    $classs    = ClassModel::all();
    $attendance = StudentAttendanceModel::whereIn('attendance_type', [1, 2, 3, 4])->get();

    return Inertia::render('Attendance', compact('attendance', 'students', 'classs'));
});
Route::get('/contact', function(){
    return Inertia::render('Contact');
});
Route::get('/teacher', function(){
    $teacher = User::where('user_type',2)->get();
        return Inertia::render('Teacher', compact('teacher'));
});

// Route::get('teacher', [FrontendTeacherController::class, 'index']);


Route::get('/login_form', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'postforgotpassword']);


Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});


Route::group(['middleware' => 'admin'], function(){

Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
Route::get('admin/admin/list', [AdminController::class, 'list']);
Route::get('admin/admin/add', [AdminController::class, 'add']);
Route::post('admin/admin/add', [AdminController::class, 'insert']);
Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

//student
Route::get('admin/student/list', [StudentController::class, 'list']);
Route::get('admin/student/add', [StudentController::class, 'add']);
Route::post('admin/student/add', [StudentController::class, 'insert']);
Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

//Parent
Route::get('admin/parent/list', [ParentController::class, 'list']);
Route::get('admin/parent/add', [ParentController::class, 'add']);
Route::post('admin/parent/add', [ParentController::class, 'insert']);
Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
Route::get('admin/parent/my_student/{id}', [ParentController::class, 'myStudent']);
Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);

//teacher
Route::get('admin/teacher/list', [TeacherController::class, 'list']);
Route::get('admin/teacher/add', [TeacherController::class, 'add']);
Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);
Route::get('admin/teacher/my_student/{id}', [TeacherController::class, 'myStudent']);
Route::get('admin/teacher/assign_student_parent/{student_id}/{parent_id}', [TeacherController::class, 'AssignStudentParent']);

//class
Route::get('admin/class/list', [ClassController::class, 'list']);
Route::get('admin/class/add', [ClassController::class, 'add']);
Route::post('admin/class/add', [ClassController::class, 'insert']);
Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

//subject
Route::get('admin/subject/list', [SubjectController::class, 'list']);
Route::get('admin/subject/add', [SubjectController::class, 'add']);
Route::post('admin/subject/add', [SubjectController::class, 'insert']);
Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

//assign_subject
Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
//single_edit
Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

Route::get('admin/change_password', [UserController::class, 'change_password']);
Route::post('admin/change_password', [UserController::class, 'update_change_password']);

//attendance
Route::get('admin/attendance/student', [AttendanceController::class, 'AttendanceStudent']);
Route::post('admin/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);

//attendance_report

Route::get('admin/attendance/report', [AttendanceController::class, 'AttendanceReport']);




    });

Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
    });

Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
   });
Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);
    });