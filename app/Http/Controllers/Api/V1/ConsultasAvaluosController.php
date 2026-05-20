<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvaluoApiRequest;
use App\Http\Requests\AvaluosApiRequest;
use App\Http\Resources\AvaluoApiResource;
use App\Models\Avaluo;

class ConsultasAvaluosController extends Controller
{

    public function consultarAvaluo(AvaluoApiRequest $request){

        $validated = $request->validated();

        $avaluo = Avaluo::where('año', $validated['año'])
                            ->where('folio', $validated['folio'])
                            ->where('usuario', $validated['usuario'])
                            ->where('estado', 'operado')
                            ->first();

        if(! $avaluo){

            return response()->json([
                'error' => 'No se encontró el avalúo.',
            ], 404);

        }

        return (new AvaluoApiResource($avaluo))->response()->setStatusCode(200);

    }

    public function consultarAvaluos(AvaluosApiRequest $request){

        $validated = $request->validated();

        $avaluos = Avaluo::with(
                                 'bloques',
                                 'predio.colindancias',
                                 'predio.propietarios.persona',
                                 'predio.terrenos',
                                 'predio.terrenosComun',
                                 'predio.construcciones',
                                 'predio.construccionesComun',
                                 'creadoPor:id,name,clave,asociacion'
                                )
                                ->where('estado', 'operado')
                                ->whereHas('predio', function($q) use ($validated){
                                    $q->where('localidad', $validated['localidad'])
                                    ->where('oficina', $validated['oficina'])
                                    ->where('tipo_predio', $validated['tipo_predio'])
                                    ->whereBetween('numero_registro', [$validated['numero_registro_inicial'], $validated['numero_registro_final']]);
                                })
                                ->get();

        if(! $avaluos->count()){

            return response()->json([
                'error' => 'No se encontraron avalúos.',
            ], 404);

        }

        return AvaluoApiResource::collection($avaluos)->response()->setStatusCode(200);

    }

}
