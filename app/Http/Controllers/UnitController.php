<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\Unit\CreateUnitRequest;
use App\Http\Requests\Unit\EditUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Responses\ApiResponse;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Date;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $year = Date('Y');
            $units = Unit::where('status', 1)
            ->paginate(10);
            return ApiResponse::success('Lista de unidades registradas', 200, $units);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUnitRequest $request)
    {
        try{
            $year = Date("Y");
            $unit_name = $request->unit_name;
            $id_academic_program = $request->id_academic_program;

            $exist_unit = Unit::where('status', 1)
            ->where('unit_name', $unit_name)
            ->where('id_academic_program', $id_academic_program)
            ->whereYear('created_at', $year)
            ->first();

            if($exist_unit){
                return ApiResponse::error('La unidad '.$unit_name.' ya se encuentra registrada, registre uno nuevo.', 500, null);
            }

            $unit = Unit::create($request->all());
            return ApiResponse::success('Programación de unidad de clase registrada correctamente', 201, $unit);
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
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUnitRequest $request, $id_unit)
    {
        try{
            $unit = Unit::find($id_unit);
            $res_update = $unit->update($request->all());
            return ApiResponse::success('Actualización de datos de la unidad', 201, $res_update);
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
    public function destroy($id_unit)
    {
        try{
            $unit = Unit::find($id_unit);
            $res_update = $unit->update(['status' => false]);
            return ApiResponse::success('Eliminación de unidad', 201, $res_update);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(), 422);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
