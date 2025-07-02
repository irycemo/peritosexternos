<?php

namespace App\Services\SGCService;

use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Http;

class SGCService{

    public function consultarPredio(int $localidad, int $oficina, int $tipo_predio, int $numero_registro):array
    {

        $response = Http::withToken(config('services.sgc.token'))
                            ->accept('application/json')
                            ->asForm()
                            ->post(
                                config('services.sgc.consulta_cuenta_predial'),
                                [
                                    'localidad' => $localidad,
                                    'oficina' => $oficina,
                                    'tipo_predio' => $tipo_predio,
                                    'numero_registro' => $numero_registro
                                ]
                            );

        if($response->status() !== 200){

            Log::error("Error al consultar predio. " . $response);

            $data = json_decode($response, true);

            if(isset($data['error'])){

                throw new GeneralException($data['error']);

            }

            throw new GeneralException("Error al consultar predio.");

        }else{

            return json_decode($response, true);

        }

    }

}