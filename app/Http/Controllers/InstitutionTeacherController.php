<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicProgram\ParamAcademicProgramRequest;
use App\Http\Requests\Institution\ParamModularCodeRequest;
use App\Http\Requests\InstitutionTeacher\EditInstitutionTeacherRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Institution_teacher;
use App\Models\Institution_teachers;
use App\Models\Teacher;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class InstitutionTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_teachers_from_ie(ParamModularCodeRequest $request)
    {
        try{
            $year = date('Y');
            $modular_code = $request->query('modular_code');

            $teachers = Institution_teacher::where('status', 1)
            ->where('modular_code', $modular_code)
            ->whereYear('created_at', $year)
            ->with([
                'teacher',
            ])
            ->paginate(10);

            return ApiResponse::success('Lista de programación acádemico', 200, $teachers);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }

    }
    public function get_teachers_from_ie_assign(ParamModularCodeRequest $request)
    {
        try{
            $year = date('Y'); //current year
            $modular_code = $request->query('modular_code');

            $teachers = Institution_teacher::where('status', 1)
            ->where('modular_code', $modular_code)
            ->whereYear('created_at', $year)
            ->with([
                'teacher',
                'teacher_area.area',
                'teacher_area.section',
                'teacher_area.grade'
            ])
            ->paginate(10);

            return ApiResponse::success('Lista de programación acádemico', 200, $teachers);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EditInstitutionTeacherRequest $request)
    {
        try{
            $ie_teacher = Institution_teacher::create($request->all());
            return ApiResponse::success('Docente registrado correctamente a la institución', 201, $ie_teacher);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Institution_teacher $institution_teachers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution_teacher $institution_teachers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution_teacher $institution_teachers)
    {
        //
    }
}
