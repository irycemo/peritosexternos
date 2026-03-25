<?php

namespace App\Services\TramitesLineaService;

use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Http;

class TramitesLineaService{

    public function desvincularAvaluo(int $id_avaluo):array
    {

        $response = Http::withToken(config('services.tramites_linea.token'))
                            ->accept('application/json')
                            ->asForm()
                            ->post(
                                config('services.tramites_linea.desvincular_avaluo'),
                                [
                                    'id' => $id_avaluo,
                                ]
                            );

        if($response->status() !== 200){

            Log::error("Error al desvincular avalúo. " . $response);

            $data = json_decode($response, true);

            if(isset($data['error'])){

                throw new GeneralException($data['error']);

            }

            throw new GeneralException("Error al desvincular avalúo.");

        }else{

            return json_decode($response, true);

        }

    }

}