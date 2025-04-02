<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminToolsController;
use App\Http\Controllers\WebapiController;

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



// Route::group(['prefix'=> 'tool', 'as'=> 'tool.'], function (){
//     Route::get('/institution-list', [WebapiController::class, 'institutionList']);
//     Route::get('/academic-year', [WebapiController::class, 'academicYear']);
//     Route::get('/academic-course', [WebapiController::class, 'academiCourse']);
//     Route::get('/academic-subject', [WebapiController::class, 'academicSubject']);
//     Route::get('/academic-course-type', [WebapiController::class, 'academicCourseType']);
//     Route::post('/academic-fee', [WebapiController::class, 'academicFee']);
// });

// Route::group(['prefix'=> 'auth', 'as'=> 'auth.'], function (){

//     Route::post('/registration', [WebapiController::class, 'registration']);
//     Route::post('/login', [WebapiController::class, 'login']);

// });

// Route::group(['prefix'=> 'student', 'as'=>'student'], function (){
//     Route::get('/', [WebapiController::class, 'studentDetails']);
//     //Route::post('/save-basic-info', [WebapiController::class, 'saveBasicInfo']);

// });

