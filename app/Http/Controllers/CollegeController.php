<?php

namespace App\Http\Controllers;

use App\Http\Requests\College\CreateCollegeRequest;
use App\Http\Responses\ApiResponse;
use App\Models\College;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $colleges = College::where('status', 1)
            ->paginate(15);
            return ApiResponse::success('Lista colegiados registrados', 200, $colleges);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCollegeRequest $request)
    {
        try{
            $college = College::create($request->all());
            return ApiResponse::success('Nuevo colegiado registrado correctamente', 201, $college);
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
    public function show(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        //
    }
}
