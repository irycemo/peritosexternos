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

    public function buscarTramiteRefrendo(int $año, int $folio, int $usuario):array
    {

        $response = Http::withToken(config('services.sgc.token'))
                            ->accept('application/json')
                            ->asForm()
                            ->post(
                                config('services.sgc.consulta_tramite_refrendo'),
                                [
                                    'año' => $año,
                                    'folio' => $folio,
                                    'usuario' => $usuario
                                ]
                            );

        if($response->status() !== 200){

            Log::error("Error al consultar trámite de refrendo. " . $response);

            $data = json_decode($response, true);

            if(isset($data['error'])){

                throw new GeneralException($data['error']);

            }

            throw new GeneralException("Error al consultar trámite de refrendo.");

        }else{

            return json_decode($response, true);

        }

    }

    public function crearTramiteRefrendo(string $solicitante, int $clave, string $email):array
    {

        $response = Http::withToken(config('services.sgc.token'))
                            ->accept('application/json')
                            ->asForm()
                            ->post(
                                config('services.sgc.crear_tramite_refrendo'),
                                [
                                    'solicitante' => $solicitante,
                                    'clave' => $clave,
                                    'email' => $email,
                                ]
                            );

        if($response->status() !== 200){

            Log::error("Error al crear trámite de refrendo. " . $response);

            $data = json_decode($response, true);

            if(isset($data['error'])){

                throw new GeneralException($data['error']);

            }

            throw new GeneralException("Error al crear trámite de refrendo.");

        }else{

            return json_decode($response, true);

        }

    }

}