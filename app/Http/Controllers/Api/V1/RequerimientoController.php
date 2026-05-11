<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrearRequerimientoRequest;
use App\Mail\RequerimientoMail;
use App\Models\Avaluo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RequerimientoController extends Controller
{

    public function hacerRequerimiento(CrearRequerimientoRequest $request){

        $validated = $request->validated();

        $avaluo = Avaluo::find($validated['avaluo_id']);

        if(!$avaluo){

            return response()->json([
                'error' => "No se encontró el avalúo.",
            ], 404);

        }

        try {

            $avaluo->requerimientos()->create([
                'usuario_sgc' => $validated['avaluo_id'],
                'descripcion' => $validated['descripcion'],
                'estado' => 'nuevo'
            ]);

            Mail::to($avaluo->creadoPor->email)->send(new RequerimientoMail($avaluo, $validated['descripcion']));

            return response()->json([
                'data' => "Operación exitosa.",
            ], 200);

        } catch (\Throwable $th) {

            Log::error("Error al hacer requerimiento desde sgc. " . $th);

            return response()->json([
                'error' => "Error al hacer requerimiento.",
            ], 500);

        }

    }

}
