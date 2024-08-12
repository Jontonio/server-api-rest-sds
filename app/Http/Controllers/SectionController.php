<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\CreateSectionRequest;
use App\Http\Requests\Section\EditSectionRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Section;
use Dotenv\Exception\ValidationException;
use Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $secciones = Section::where('status','!=', 0)
            ->orderBy('id_section', 'asc')
            ->paginate(10);
            return ApiResponse::success('Lista de secciones', 200, $secciones);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSectionRequest $request)
    {
        try{
            $request->merge(['section_name' => strtoupper($request->section_name)]);
            $section = Section::create($request->all());
            return ApiResponse::success('Nueva sección registrada correctamente', 201, $section);
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
    public function show($id_section)
    {
        try{
            $section = Section::find($id_section);
            return ApiResponse::success('Obtener sección', 201, $section);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(), 422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSectionRequest $request, $id_section)
    {
        try{
            $section = Section::find($id_section);
            $res_update = $section->update($request->all());
            return ApiResponse::success('Actualización de datos de la sección', 201, $res_update);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(), 422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
