<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\CreateTeacherRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Teacher;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $teachers = Teacher::where('status', 1)
            ->paginate(10);
            return ApiResponse::success('Lista docentes registrados', 200, $teachers);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function get_teacher_by_document($id_card)
    {
        try{
            $teacher = Teacher::where('id_card', $id_card)->first();
            return ApiResponse::success('Docente registrado', 200, $teacher);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTeacherRequest $request)
    {
        try{
            $validatedData = $request->validated();
            $exist_teacher = Teacher::where('id_card', $validatedData['id_card'])->first();
            if ($exist_teacher) {
                $exist_teacher->update($validatedData);
                return ApiResponse::success('Docente actualizado correctamente', 200, $exist_teacher);
            } else {
                $teacher = Teacher::create($validatedData);
                return ApiResponse::success('Docente registrado correctamente', 201, $teacher);
            }
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
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
