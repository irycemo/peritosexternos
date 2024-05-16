<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Avaluo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvaluoRequest;
use App\Http\Resources\AvaluoResource;

class AvaluoApiController extends Controller
{

    public function consultarAvaluo(AvaluoRequest $request){

        $validated = $request->validated();

        $avaluo = Avaluo::with('predio.colindancias')->where('año', $validated['año'])->where('folio', $validated['folio'])->first();

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        /* if(!$avaluo->predio->valor_catastral){

            return response()->json([
                'error' => "El avalúo no tiene valor catastral.",
            ], 401);
        } */

        return (new AvaluoResource($avaluo))->response()->setStatusCode(200);

    }

    public function consultarAvaluoId(Request $request){

        $validated = $request->validate(['id' => 'required|numeric|min:1']);

        $avaluo = Avaluo::with('predio.colindancias')->find($validated['id']);

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        /* if(!$avaluo->predio->valor_catastral){

            return response()->json([
                'error' => "El avalúo no tiene valor catastral.",
            ], 401);
        } */

        return (new AvaluoResource($avaluo))->response()->setStatusCode(200);

    }

    public function reactivarAvaluo(Request $request){

        $validated = $request->validate(['id' => 'required|numeric|min:1']);

        $avaluo = Avaluo::find($validated['id']);

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        try {

            $avaluo->update(['estado' => 'nuevo']);

            return response()->json([
                'error' => "Reactivación exitosa.",
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'error' => "Error al reactivar el avalúo.",
            ], 500);

        }

    }

    public function operarAvaluo(Request $request){

        $validated = $request->validate(['id' => 'required|numeric|min:1']);

        $avaluo = Avaluo::find($validated['id']);

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        try {

            $avaluo->update(['estado' => 'operado']);

            return response()->json([
                'error' => "Operación exitosa.",
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'error' => "Error al operar el avalúo.",
            ], 500);

        }

    }

}
