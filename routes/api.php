<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebapiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=> 'tool', 'as'=> 'tool.'], function (){
    Route::get('/institution-list', [WebapiController::class, 'institutionList']);
    Route::get('/academic-year', [WebapiController::class, 'academicYear']);
    Route::get('/academic-course/{institution_id}', [WebapiController::class, 'academiCourse']);
    Route::get('/academic-subject/{academic_course}', [WebapiController::class, 'academicSubject']);
    Route::get('/academic-course-type', [WebapiController::class, 'academicCourseType']);
    Route::post('/academic-fee', [WebapiController::class, 'academicFee']);
});

Route::group(['prefix'=> 'auth', 'as'=> 'auth.'], function (){

    Route::post('/registration', [WebapiController::class, 'registration']);
    Route::post('/payment-response', [WebapiController::class, 'paymentResponse']);
    Route::post('/login', [WebapiController::class, 'login']);
    Route::post('/panel-login', [WebapiController::class, 'studentPanelLogin']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::group(['prefix'=> 'student', 'as'=>'student'], function (){
        Route::get('/', [WebapiController::class, 'studentDetails']);
        Route::post('/save-student-info', [WebapiController::class, 'SaveStudentInfo']);
        Route::post('/update-basic-info', [WebapiController::class, 'UpdateBasicInfo']);
        Route::get('/personal-info', [WebapiController::class, 'personalInfo']);
        Route::post('/update-address', [WebapiController::class, 'UpdateAddress']);
        Route::post('/update-password', [WebapiController::class, 'UpdatePassword']);
    });
});



