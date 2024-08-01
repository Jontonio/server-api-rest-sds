<?php

namespace App\Http\Middleware\Auth;

use App\Http\Responses\ApiResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;

        $existUser = User::where('id', $id)->first();

        if (!$existUser) {
            return ApiResponse::error('El usuario con ID '.$id.' no se encuentra aun registrado', 404);
        }

        return $next($request);
    }
}
