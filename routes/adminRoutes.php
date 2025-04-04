<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminToolsController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminFeeController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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


Route::group(['prefix'=> 'admin', 'as'=> 'admin.'], function (){

    Route::get('/', [AdminController::class, 'dashboard']);
    Route::post('single-update-data', [AdminController::class, 'singleUpdateData']);
    Route::post('get-single-data', [AdminController::class, 'getSingleData']);
    Route::post('get-address', [AdminController::class, 'get_address']);
    Route::post('select-institution', [AdminController::class, 'selectInstitution']);

    // roles and permissions Process
    Route::get('/roles', [RoleController::class, 'Roles'])->name('roles');
    Route::get('/get-roles', [RoleController::class, 'getRoles']);
    Route::post('/update-role-status', [RoleController::class, 'updateRoleStatus']);
    Route::post('/update-role/{id}', [RoleController::class, 'updateRole']);
    Route::post('/add-role', [RoleController::class, 'AddRole']);
    Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);

    //manage permissions
    Route::get('/permission', [PermissionController::class, 'Permission'])->name('permission');
    Route::post('/add-permission', [PermissionController::class, 'AddPermission']);
    Route::get('/get-permissions', [PermissionController::class, 'getPermissions']);
    Route::post('/update-permission-status', [PermissionController::class, 'updatePermissionStatus']);
    Route::post('/update-permission/{id}', [PermissionController::class, 'updatePermission']);
    Route::delete('/delete-permission/{id}', [PermissionController::class, 'deletePermission']);
    
    // Registration Process
    Route::group(['prefix'=> 'registration', 'as'=> 'registration.'], function (){
        Route::get('/new-registration', [RegistrationController::class, 'index']);
        Route::get('/approved-registration', [RegistrationController::class, 'ApprovedRegistration']);
        Route::get('/rejected-registration', [RegistrationController::class, 'RejectedRegistration']);
        Route::post('/approve-registration/{id}', [RegistrationController::class, 'Approve']);
        Route::post('/reject-registration/{id}', [RegistrationController::class, 'Reject']);
        Route::post('/add-new-registration', [RegistrationController::class, 'AdminnewRegistration']);
    });

    Route::group(['prefix'=> 'tools', 'as'=> 'tools'], function (){
        // Route::get('/academic-year', [AdminToolsController::class, 'academicYear']);
        // Route::post('/post-academic-year', [AdminToolsController::class, 'postAcademicYear']);
        // Route::get('/academic-course', [AdminToolsController::class, 'academiCourse']);
        // Route::post('/academic-course', [AdminToolsController::class, 'postAcademiCourse']);
        // Route::get('/academic-fee', [AdminToolsController::class, 'academicFee']);
        // Route::post('/academic-fee', [AdminToolsController::class, 'postAcademicFee']);
        // Route::get('/required-document', [AdminToolsController::class, 'requiredDocument']);
        // Route::post('/required-document', [AdminToolsController::class, 'postRequiredDocument']);
        // Route::get('/subject-list', [AdminToolsController::class, 'subjectList']);
        // Route::post('/post-subject', [AdminToolsController::class, 'postSubject']);
        // Route::get('/course-type-list', [AdminToolsController::class,'courseTypeList']);
        // Route::post('/post-course-type', [AdminToolsController::class, 'postCourseType']);
        // Route::post('/upload-academic-course', [AdminToolsController::class, 'uploadAcademicCourse']);

        Route::get('/add-course', [App\Http\Controllers\CourseController::class, 'index']);
        Route::get('/update-course/{id}', [App\Http\Controllers\CourseController::class, 'updateStatus']);
        Route::post('/add-course', [App\Http\Controllers\CourseController::class, 'store']);

        Route::get('/add-university', [UniversityController::class, 'index']);
        Route::get('/update-university/{id}', [UniversityController::class, 'updateStatus']);
        Route::post('/add-university', [UniversityController::class, 'store']);
        Route::get('/get-university', [UniversityController::class, 'getUniversity']);
        Route::post('/university-status/{id}', [UniversityController::class, 'updateUniversityStatus']);
        Route::post('/update-university/{id}', [UniversityController::class, 'updateUniversity']);

        Route::get('/add-category', [CategoryController::class, 'index']);
        Route::get('/update-category/{id}', [CategoryController::class, 'updateStatus']);
        Route::post('/add-category', [CategoryController::class, 'store']);
        Route::get('/get-category', [CategoryController::class, 'getCategory']);
        Route::post('/category-status/{id}', [CategoryController::class, 'updateCategoryStatus']);
        Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory']);

        // Route::get('/add-subject', [App\Http\Controllers\SubjectController::class, 'index']);
        // Route::get('/update-subject/{id}', [App\Http\Controllers\SubjectController::class, 'updateStatus']);
        // Route::post('/add-subject', [App\Http\Controllers\SubjectController::class, 'store']);


    });

    Route::group(['prefix'=> 'students', 'as'=> 'students.'], function (){
        Route::get('/add-student', [StudentController::class, 'create']);
        Route::post('/ajex-academic-course-type', [StudentController::class, 'ajexAcademiCourseType']);
        Route::post('/new-student', [StudentController::class, 'postNewStudent']);
        Route::get('/students-list', [StudentController::class, 'index']);
        Route::get('/student-basic-info/{studentID}', [StudentController::class, 'studentBasicInfo']);
        Route::post('/student-basic-info', [StudentController::class, 'studentBasicInfoUpdate']);
        Route::get('/student-address-info/{studentID}', [StudentController::class, 'studentAddressInfoUpdate']);
        Route::post('/add-address-info', [StudentController::class, 'addStudentAddress']);
        Route::get('/student-academy-info/{studentID}', [StudentController::class, 'studentAcademyInfo']);
        Route::post('new-student-academy', [StudentController::class, 'newStudentAcademy']);
        Route::get('student-academy-fee-info/{studentID}', [StudentController::class, 'studentAcademicFeeInfo']);
        Route::get('student-document-info/{studentID}', [StudentController::class, 'studentDocumentInfo']);
        Route::post('add-student-document', [StudentController::class, 'addStudentDocument']);
        Route::post('collect-student-fee', [StudentController::class, 'collectStudentFee']);
    });

    // Route::group(['prefix'=> 'fee', 'as'=> 'fee.'], function (){
    //     Route::get('/collect-fee', [AdminFeeController::class, 'collectFee']);
    //     Route::get('/collected-fee', [AdminFeeController::class, 'collectedFee']);
    //     Route::get('/due-fee', [AdminFeeController::class, 'dueFee']);
    // });

    Route::group(['prefix'=> 'college', 'as'=> 'college.'], function(){
        Route::get('/add-college', [App\Http\Controllers\CollegeController::class, 'create']);
        Route::post('/add-college', [App\Http\Controllers\CollegeController::class, 'store']);
        Route::get('/colleges-list', [App\Http\Controllers\CollegeController::class, 'index']);
        Route::get('/college-details/{id}', [App\Http\Controllers\CollegeController::class, 'collegeDetails']);
        Route::get('/college-students/{id}', [App\Http\Controllers\CollegeController::class, 'collegeStudents']);
        Route::get('/college-courses/{id}', [App\Http\Controllers\CollegeController::class, 'collegeCourses']);
        Route::post('/change-status', [App\Http\Controllers\CollegeController::class, 'changeStatus']);
        Route::post('/edit', [App\Http\Controllers\CollegeController::class, 'edit']);
        Route::post('/update', [App\Http\Controllers\CollegeController::class, 'updateCollegeInfo']);
        Route::post('/college-user-list', [App\Http\Controllers\CollegeController::class, 'collegeUserList']);
        Route::post('/add-college-courses', [App\Http\Controllers\CollegeController::class, 'addCollegeCourses']);

    });

    // Route::group(['prefix'=> 'teacher', 'as'=> 'teacher.'], function(){
    //     Route::get('/teacher-list', [AdminTeacherController::class, 'teacherList']);
    //     Route::post('/add-teacher', [AdminTeacherController::class, 'addTeacher']);
    //     Route::get('/attendance', [AdminTeacherController::class, 'attendance']);
    //     Route::post('/add-teacher-attendance', [AdminTeacherController::class, 'addTeacherAttendance']);
    //     Route::get('/salary', [AdminTeacherController::class, 'teacherSalary']);
    //     Route::get('/teacher-list-json', [AdminTeacherController::class, 'teacherListJson']);
    //     Route::post('/teacher-attendance-json', [AdminTeacherController::class, 'teacherAttendanceJson']);
    //     Route::post('/add-teacher-salary', [AdminTeacherController::class, 'addTeacherSalary']);
    //     Route::post('/get-single-salary-json', [AdminTeacherController::class, 'getSingleSalaryJson']);
    //     Route::get('/teacher-details/{id}', [AdminTeacherController::class, 'teacherDetails']);
    //     Route::get('/teacher-attendance/{id}', [AdminTeacherController::class, 'teacherAttendance']);
    //     Route::get('/teacher-salary/{id}', [AdminTeacherController::class, 'singleTeacherSalary']);

    // });

    // Route::group(['prefix'=> 'event', 'as'=> 'event.'], function (){

    //     Route::get('/practical-event', [AdminEventController::class, 'practicalEvent']);
    //     Route::post('/get-academic-batch', [AdminEventController::class, 'get_academic_batch']);

    // });




});

