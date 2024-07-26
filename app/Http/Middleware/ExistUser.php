<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistUser
{

    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;

        $existingParticipant = User::where('id', $id)->first();

        if (!$existingParticipant) {
            return ApiResponse::error('El usuario con ID '.$id.' no se encuntra aun registrado', 404);
        }
        return $next($request);
    }
}
