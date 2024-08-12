<?php

namespace App\Http\Middleware\Unit;

use App\Http\Responses\ApiResponse;
use App\Models\Unit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistUnit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id_unit;

        $existingParticipant = Unit::where('id_unit', $id)->first();

        if (!$existingParticipant) {
            return ApiResponse::error('La unidad con ID '.$id.' no se encuentra aun registrado', 404);
        }
        return $next($request);
    }
}
