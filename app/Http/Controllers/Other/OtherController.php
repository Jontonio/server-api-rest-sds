<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\QueryAPIReniecRequest;
use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class OtherController extends Controller
{

    public function api_query_reniec(QueryAPIReniecRequest $request)
    {
        try {
            $dni = $request->id_card;

            $response = Http::get(env('API_RENIEC').''.$dni);

            if($response->successful()){

                $res = $response->json();

                $data['id_card'] = $res['numeroDocumento'];
                $data['names'] = $res['nombres'];
                $data['first_name'] = $res['apellidoPaterno'];
                $data['last_name'] = $res['apellidoMaterno'];

                return ApiResponse::success('Datos consultados al DNI '.$dni, 200, $data);
            }else{
                $statusCode = $response->status();
                return ApiResponse::error('Error al consultar API, intentelo nuevamente', $statusCode);
            }

        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (InternalErrorException $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 500);
        }
    }
}
