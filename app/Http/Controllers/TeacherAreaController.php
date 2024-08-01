<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherArea\CreateTeacherAreaRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Teacher_area;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class TeacherAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTeacherAreaRequest $request)
    {
        try{

            $year = date('Y'); //current year

            $id_area = $request->id_area;
            $id_section = $request->id_section;
            $id_grade = $request->id_grade;
            $id_ie_teacher = $request->id_ie_teacher;

            $exist_teacher_assign = Teacher_area::where('status', 1)
                                    ->where('id_area', $id_area)
                                    ->where('id_section', $id_section)
                                    ->where('id_grade', $id_grade)
                                    ->where('id_ie_teacher', $id_ie_teacher)
                                    ->whereYear('created_at', 2024)
                                    ->get();

            if($exist_teacher_assign->isNotEmpty()){
                return ApiResponse::error('El docente ya se encuentra asigando en ese área y curso', 422, null);
            }

            $teacher_area = Teacher_area::create($request->all());
            return ApiResponse::success('Docente asignado al área y grado correctamente', 201, $teacher_area);
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
    public function show(Teacher_area $teacher_area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher_area $teacher_area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher_area $teacher_area)
    {
        //
    }
}
