<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $token = JWTAuth::fromUser($user);

            $tokenWithData = JWTAuth::setToken($token)->getPayload()->toArray();
            if ($user->id_inia_station) {
                $tokenWithData['id_inia_station'] = $user->id_inia_station;
            }
            $token = JWTAuth::fromUser($user, $tokenWithData);

            $request->merge(['userAuthenticated' => $user, 'token' => $token, 'roles' => $user->getRoleNames()]);

        } catch (TokenExpiredException $e) {
            return ApiResponse::error('Credenciales de acceso expirado, inicie nuevamente la sesión.', 401);
        } catch (TokenInvalidException $e) {
            return ApiResponse::error('Credenciales de acceso inválida.', 401);
        } catch (JWTException $e) {
            return ApiResponse::error('Acceso no autorizado, inicie sesión para continuar.', 401);
        } catch (Exception $e) {
            return ApiResponse::error('Acceso no autorizado.', 401);
        }

        return $next($request);
    }
}
