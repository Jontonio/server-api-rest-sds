<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        try {
            $area = Area::where('status','!=', 0)->paginate(10);
            return ApiResponse::success('Lista de cargos ',200, $area);
       } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
    }
}
