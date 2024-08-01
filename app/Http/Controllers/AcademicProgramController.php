<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicProgram\CreateAcademicProgramRequest;
use App\Http\Requests\AcademicProgram\ParamAcademicProgramRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Academic_program;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AcademicProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_academic_program_from_ie(ParamAcademicProgramRequest $request)
    {
        try{
            $modular_code = $request->query('modular_code');
            $id_academic_calendar = $request->query('id_academic_calendar');

            $cademic_program = Academic_program::where('status', 1)
            ->where('modular_code', $modular_code)
            ->where('id_academic_calendar', $id_academic_calendar)
            ->paginate(15);

            return ApiResponse::success('Lista de programación acádemico', 200, $cademic_program);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_academic_program_from_ie(CreateAcademicProgramRequest $request)
    {
        try{
            $modular_code = $request->modular_code;
            $id_academic_calendar = $request->id_academic_calendar;
            $academic_program_bim = $request->academic_program_bim;

            $exist_academic_program = Academic_program::where('status', 1)
            ->where('modular_code', $modular_code)
            ->where('academic_program_bim', $academic_program_bim)
            ->where('id_academic_calendar', $id_academic_calendar)
            ->first();

            if($exist_academic_program){
                return ApiResponse::error('La programación académica con el periodo '.$academic_program_bim.' ya se encuentra registrada, registre uno nuevo.', 500, $exist_academic_program);
            }

            $academic_program = Academic_program::create($request->all());
            return ApiResponse::success('Nuevo programación académica registrado correctamente', 201, $academic_program);
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
    public function show(Academic_program $academic_program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic_program $academic_program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic_program $academic_program)
    {
        //
    }
}
