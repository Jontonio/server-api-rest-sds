<?php

namespace App\Http\Middleware\Section;

use App\Http\Responses\ApiResponse;
use App\Models\Section;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistSectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $idSection = $request->route('id_section');

        $existSection = Section::find($idSection);

        if (!$existSection) {
            return ApiResponse::error('La sección con ID ' . $idSection . ' no se encuentra aun registrada', 404);
        }

        return $next($request);
    }
}
