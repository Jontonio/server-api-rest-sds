<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grade\CreateGradeRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Grade;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $grades = Grade::where('status','!=', 0)
            ->orderBy('id_grade', 'asc')
            ->paginate(10);
            return ApiResponse::success('Lista de grados', 200, $grades);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGradeRequest $request)
    {
        try{
            $grade = Grade::create($request->all());
            return ApiResponse::success('Nuevo grado registrado correctamente', 201, $grade);
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
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
