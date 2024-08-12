<?php

namespace App\Http\Controllers;

use App\Http\Requests\Institution\CreateInstitutionRequest;
use App\Http\Requests\Institution\ParamModularCodeRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Institution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $institutions = Institution::where('status','!=', 0)->paginate(10);
            return ApiResponse::success('Lista de instituciones ', 200, $institutions);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInstitutionRequest $request)
    {
        try{
            $institution = Institution::create($request->all());
            return ApiResponse::success('Nueva institución registrado correctamente', 201, $institution);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ParamModularCodeRequest $request, $modular_code)
    {
        try{
            $institution = Institution::where('status','!=', 0)->where('modular_code', $modular_code)->first();
            return ApiResponse::success('Institución', 200, $institution);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution $institution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        //
    }
}
