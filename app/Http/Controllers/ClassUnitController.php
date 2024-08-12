<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassUnit\CreateClassUnitRequest;
use App\Http\Requests\ClassUnit\UpdateVerifiedClassUnitRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Class_unit;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeUnit\ClassUnit;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class ClassUnitController extends Controller
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
    public function store(CreateClassUnitRequest $request)
    {
        try{

            $file = $request->file('file');

            $path = $file->store('public/unit_class');

            $url = Storage::url($path);

            $class_unit = new Class_unit();
            $class_unit->id_teacher_area = $request->id_teacher_area;
            $class_unit->class_unit_title = $request->class_unit_title;
            $class_unit->class_unit_description = $request->class_unit_description;
            $class_unit->class_unit_file_url = $url;
            $class_unit->id_unit = $request->id_unit;

            $class_unit->save();

            return ApiResponse::success('Unidad de clase registrada correctamente', 201, $class_unit);
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
    public function show(Class_unit $class_unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Class_unit $class_unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_verified(UpdateVerifiedClassUnitRequest $request, $id_class_unit)
    {
        try{
            $class_unit = Class_unit::where('id_class_unit', $id_class_unit)->first();
            if (!$class_unit) {
                return ApiResponse::error('Unidad de clase no encontrada', 404);
            }
            $class_unit->verified = !$request->verified;
            $class_unit->save();
            return ApiResponse::success('Actualización de revisión de unidad correctamente', 200, $class_unit);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Class_unit $class_unit)
    {
        //
    }
}
