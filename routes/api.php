<?php

use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassUnitController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InstitutionTeacherController;
use App\Http\Controllers\Other\OtherController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherAreaController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UnitController;
use App\Http\Middleware\AcademicProgram\ExistAcademicProgram;
use App\Http\Middleware\Auth\ExistUserMiddleware;
use App\Http\Middleware\ClassUnit\ExistClassUnit;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\Section\ExistSectionMiddleware;
use App\Http\Middleware\Unit\ExistUnit;
use App\Models\Teacher;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['msg' => 'welcome to SIRAUN'];
});

//Endpoint auth
Route::post('login', [AuthController::class,'login']);
Route::middleware([JwtMiddleware::class])->group(function() {
    Route::post('register-user', [AuthController::class,'register']);
    Route::get('get-users',[AuthController::class,'getUsers']);
    Route::post('assign-user-role/{id}',[AuthController::class,'assignUserRole'])
        ->middleware([ExistUserMiddleware::class]);
    Route::get('user-check', [AuthController::class,'checkUser']);
    Route::get('logout', [AuthController::class,'logout']);
});

//Endpoint institutions
Route::get('get-institutions', [InstitutionController::class, 'index']);
Route::get('get-institution/{modular_code}', [InstitutionController::class, 'show']);
Route::post('add-institution', [InstitutionController::class, 'store']);

//Endpoint sections
Route::get('get-sections', [SectionController::class,'index']);
Route::post('register-section', [SectionController::class,'store']);
Route::get('get-section/{id_section}', [SectionController::class,'show'])
    ->middleware([ExistSectionMiddleware::class]);
Route::patch('update-section/{id_section}', [SectionController::class,'update'])
    ->middleware([ExistSectionMiddleware::class]);

//Endpoint grades
Route::get('get-grades', [GradeController::class,'index']);
Route::post('register-grade', [GradeController::class,'store']);

//Endpoint academic calendar
Route::get('get-academic-calendars', [AcademicCalendarController::class,'index']);
Route::post('register-academic-calendar', [AcademicCalendarController::class,'store']);
Route::get('get-current-calendar-academic', [AcademicCalendarController::class,'current_calendar']);

//Endpoint academic program
Route::get('get-academic-program-from-ie',[AcademicProgramController::class,'get_academic_program_from_ie']);
Route::get('get-units-from-program-academic/{id_academic_program}',[AcademicProgramController::class,'get_units_from_program_academic'])
        ->middleware([ExistAcademicProgram::class]);
Route::post('register-academic-program-from-ie',[AcademicProgramController::class,'store_academic_program_from_ie']);
Route::patch('update-academic-program/{id_academic_program}',[AcademicProgramController::class,'update'])
        ->middleware([ExistAcademicProgram::class]);

//Endpoint area
Route::get('get-areas', [AreaController::class,'index']);
Route::post('register-area', [AreaController::class,'store']);
Route::get('get-areas-with-teacher-and-class-unit', [AreaController::class,'get_areas_with_teacher_and_class_unit']);

//Endpoint college
Route::get('get-colleges', [CollegeController::class,'index']);
Route::post('register-college', [CollegeController::class,'store']);

//Endpoint teacher
Route::get('get-teachers', [TeacherController::class,'index']);
Route::post('register-teacher', [TeacherController::class,'store']);
Route::get('get-teacher-by-document/{id_card}', [TeacherController::class,'get_teacher_by_document']);

//Endpoint institution teacher
Route::get('get-teachers-from-ie', [InstitutionTeacherController::class,'get_teachers_from_ie']);
Route::get('get-teachers-from-ie-assign', [InstitutionTeacherController::class,'get_teachers_from_ie_assign']);
Route::post('register-institution-teacher', [InstitutionTeacherController::class,'store']);

//Endpoint teacher area
Route::post('register-teacher-area', [TeacherAreaController::class,'store']);

//Endpoint class unit
Route::post('register-class-unit', [ClassUnitController::class,'store']);
Route::patch('update-verified-class-unit/{id_class_unit}', [ClassUnitController::class,'update_verified'])
        ->middleware([ExistClassUnit::class]);

//Endpoint other
Route::post('api-query-reniec', [OtherController::class,'api_query_reniec']);

//Endpoint unit
Route::post('register-unit', [UnitController::class,'store']);
Route::post('get-units', [UnitController::class,'index']);
Route::patch('update-unit/{id_unit}', [UnitController::class,'update'])
        ->middleware([ExistUnit::class]);
Route::delete('delete-unit/{id_unit}', [UnitController::class,'destroy'])
        ->middleware([ExistUnit::class]);

// Call storage link
Route::get('ng', function () {
    Artisan::call('storage:link');
});
