<?php

namespace App\Http\Middleware\AcademicProgram;

use App\Http\Responses\ApiResponse;
use App\Models\Academic_program;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistAcademicProgram
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id_academic_program;

        $existingParticipant = Academic_program::where('id_academic_program', $id)->first();

        if (!$existingParticipant) {
            return ApiResponse::error('La programación académica con ID '.$id.' no se encuentra aun registrado', 404);
        }
        return $next($request);
    }
}
