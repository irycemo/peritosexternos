<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcreditarPagoRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AcreditarPagoController extends Controller
{

    public function __invoke(AcreditarPagoRequest $request)
    {

        Log::info('Request received', [
            'ipAddresses' => $request->getClientIpAddresses(),
            'parameters' =>  $request->all()
        ]);

        $validated = $request->validated();

        $linea_de_captura = app()->isProduction() ? $validated['c_referencia'] : $validated['referencia'];

        try {

            $response = Http::withToken(config('services.sgc.token'))
                            ->accept('application/json')
                            ->asForm()
                            ->post(
                                config('services.sgc.acreditar_pago'),
                                [
                                    'linea_captura' => $linea_de_captura
                                ]
                            );

            if($response->status() !== 200){

                Log::warning("Error al acreditar pago, línea de captura: " . $linea_de_captura);

                return redirect()->route('dashboard', ['error' => 'No fue posible acreditar el trámite.']);

            }else{

                return redirect()->route('dashboard', ['success' => 'El trámite fue acreditado con éxito.']);

            }

        } catch (\Throwable $th) {

            Log::error("Error al acreditar pago desde servicio de pago en línea. " . $th);

            return response()->json([
                'result' => 'error',
            ], 500);

        }

    }

}
