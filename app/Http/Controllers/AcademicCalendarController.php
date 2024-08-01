<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicCalendar\CreateAcademicCalendarRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Academic_calendar;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AcademicCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $cademic_calendar = Academic_calendar::where('status','!=', 0)
            ->orderBy('academic_calendar_year', 'desc')
            ->paginate(10);
            return ApiResponse::success('Lista de calendario acádemico', 200, $cademic_calendar);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
    /**
     * Display one calendar academic.
     */
    public function current_calendar()
    {
        try{
            $year = date("Y"); // current year
            $academic_calendar = Academic_calendar::where('status','!=', 0)
            ->where('academic_calendar_year','=', $year)
            ->first();
            if( !$academic_calendar ){
                return ApiResponse::success('Calendario académico no habilitado', 200, $academic_calendar);
            }
            return ApiResponse::success('Canledario académico - '.$academic_calendar->academic_calendar_year, 200, $academic_calendar);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAcademicCalendarRequest $request)
    {
        try{
            $academic_calendar = Academic_calendar::create($request->all());
            return ApiResponse::success('Nuevo calendario académico registrado correctamente', 201, $academic_calendar);
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
    public function show($id_academic_calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic_calendar $academic_calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic_calendar $academic_calendar)
    {
        //
    }
}
