<?php

namespace App\Http\Middleware\ClassUnit;

use App\Http\Responses\ApiResponse;
use App\Models\Class_unit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistClassUnit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $id = $request->id_class_unit;

        $existingParticipant = Class_unit::where('id_class_unit', $id)->first();

        if (!$existingParticipant) {
            return ApiResponse::error('La unidad de clases '.$id.' no se encuentra aun registrado', 404);
        }
        return $next($request);
    }
}
