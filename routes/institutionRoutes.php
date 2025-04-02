<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstitutionFeeController;
use App\Http\Controllers\InstitutionStudentsController;
use App\Http\Controllers\InstitutionTeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=> 'institution', 'as'=> 'institution.'], function (){

    Route::get('/', [InstitutionController::class, 'dashboard']);

    Route::post('single-update-data', [AdminController::class, 'singleUpdateData']);
    Route::post('get-single-data', [AdminController::class, 'getSingleData']);
    Route::get('institution-profile', [InstitutionController::class, 'institutionProfile']);
    Route::post('update-institution-logo', [InstitutionController::class, 'updateInstitutionLogo']);
    Route::post('update-institution-info', [InstitutionController::class, 'updateInstitutionInfo']);
    Route::post('add-bank', [InstitutionController::class, 'addBank']);
    Route::group(['prefix'=> 'tools', 'as'=> 'tools'], function (){
        Route::get('/academic-year', [InstitutionController::class, 'academicYear']);
        Route::post('/post-academic-year', [InstitutionController::class, 'postAcademicYear']);
        Route::get('/academic-course', [InstitutionController::class, 'academiCourse']);
        Route::post('/academic-course', [InstitutionController::class, 'postAcademiCourse']);
        Route::get('/academic-fee', [InstitutionController::class, 'academicFee']);
        Route::post('/academic-fee', [InstitutionController::class, 'postAcademicFee']);
        Route::get('/required-document', [InstitutionController::class, 'requiredDocument']);
        Route::post('/required-document', [InstitutionController::class, 'postRequiredDocument']);
        Route::get('/subject-list', [InstitutionController::class,'subject_list']);
        Route::post('/post-subject', [InstitutionController::class, 'postSubject']);
    });

    Route::group(['prefix'=> 'students', 'as'=> 'students.'], function (){
        Route::get('/add-student', [InstitutionStudentsController::class, 'addStudent']);
        Route::post('/ajex-academic-course-type', [InstitutionStudentsController::class, 'ajexAcademiCourseType']);
        Route::post('/new-student', [InstitutionStudentsController::class, 'postNewStudent']);
        Route::get('/students-list', [InstitutionStudentsController::class, 'studentsList']);
        Route::get('/student-basic-info/{studentID}', [InstitutionStudentsController::class, 'studentBasicInfo']);
        Route::post('/student-basic-info', [InstitutionStudentsController::class, 'studentBasicInfoUpdate']);
        Route::get('/student-address-info/{studentID}', [InstitutionStudentsController::class, 'studentAddressInfoUpdate']);
        Route::post('/add-address-info', [InstitutionStudentsController::class, 'addStudentAddress']);
        Route::get('/student-academy-info/{studentID}', [InstitutionStudentsController::class, 'studentAcademyInfo']);
        Route::post('new-student-academy', [InstitutionStudentsController::class, 'newStudentAcademy']);
        Route::get('student-academy-fee-info/{studentID}', [InstitutionStudentsController::class, 'studentAcademicFeeInfo']);
        Route::post('collect-student-fee', [InstitutionStudentsController::class, 'collectStudentFee']);
        Route::get('student-document-info/{studentID}', [InstitutionStudentsController::class, 'studentDocumentInfo']);
        Route::post('add-student-document', [InstitutionStudentsController::class, 'addStudentDocument']);

    });

    Route::group(['prefix'=> 'fee', 'as'=> 'fee.'], function (){
        Route::get('/collect-fee', [InstitutionFeeController::class, 'collectFee']);
        Route::get('/collected-fee', [InstitutionFeeController::class, 'collectedFee']);
        Route::get('/due-fee', [InstitutionFeeController::class, 'dueFee']);
        Route::get('/print-receipt/{id}', [InstitutionFeeController::class, 'printReceipt']);
        //Route::post('/student-due-fee-json', [InstitutionFeeController::class, 'studentDueFeeJson']);
    });

    Route::group(['prefix'=> 'teacher', 'as'=> 'teacher.'], function(){
        Route::get('/teacher-list', [InstitutionTeacherController::class, 'teacherList']);
        Route::post('/add-teacher', [InstitutionTeacherController::class, 'addTeacher']);
        Route::get('/attendance', [InstitutionTeacherController::class, 'attendance']);
        Route::post('/add-teacher-attendance', [InstitutionTeacherController::class, 'addTeacherAttendance']);
        Route::get('/salary', [InstitutionTeacherController::class, 'teacherSalary']);
        Route::get('/teacher-list-json', [InstitutionTeacherController::class, 'teacherListJson']);
        Route::post('/teacher-attendance-json', [InstitutionTeacherController::class, 'teacherAttendanceJson']);
        Route::post('/add-teacher-salary', [InstitutionTeacherController::class, 'addTeacherSalary']);
        Route::post('/get-single-salary-json', [InstitutionTeacherController::class, 'getSingleSalaryJson']);
        Route::get('/teacher-details/{id}', [InstitutionTeacherController::class, 'teacherDetails']);
        Route::get('/teacher-attendance/{id}', [InstitutionTeacherController::class, 'teacherAttendance']);
        Route::get('/teacher-salary/{id}', [InstitutionTeacherController::class, 'singleTeacherSalary']);

    });

});

