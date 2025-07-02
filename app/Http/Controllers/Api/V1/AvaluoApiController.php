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

        $avaluo = Avaluo::with('predio.colindancias')
                            ->where('año', $validated['año'])
                            ->where('folio', $validated['folio'])
                            ->where('usuario', $validated['usuario'])
                            ->first();

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        if($avaluo->estado != 'concluido'){

            return response()->json([
                'error' => "El avalúo debe estar concluido, solicite al valuador lo concluya.",
            ], 401);

        }

        $avaluo->load('predio.propietarios.persona');

        return (new AvaluoResource($avaluo))->response()->setStatusCode(200);

    }

    public function consultarAvaluoId(Request $request){

        $validated = $request->validate(['id' => 'required|numeric|min:1']);

        $avaluo = Avaluo::with('predio.colindancias', 'predio.propietarios.persona')->find($validated['id']);

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        if($avaluo->estado != 'concluido'){

            return response()->json([
                'error' => "El avalúo debe estar concluido, solicite al valuador lo concluya.",
            ], 401);

        }

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
                'data' => "Reactivación exitosa.",
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
                'data' => "Operación exitosa.",
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'error' => "Error al operar el avalúo.",
            ], 500);

        }

    }

}
