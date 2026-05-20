<?php

namespace App\Http\Resources;

use App\Http\Resources\BloquesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvaluoApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'folio' => $this->año . '-' . $this->folio . '-' . $this->usuario,
            'clasificacion_zona' => $this->clasificacion_zona,
            'construccion_dominante' => $this->construccion_dominante,
            'agua' => $this->agua ? 'Si' : 'No',
            'drenaje' => $this->drenaje ? 'Si' : 'No',
            'pavimento' => $this->pavimento ? 'Si' : 'No',
            'energia_electrica' => $this->energia_electrica ? 'Si' : 'No',
            'alumbrado_publico' => $this->alumbrado_publico ? 'Si' : 'No',
            'banqueta' => $this->banqueta ? 'Si' : 'No',
            'observaciones' => $this->observaciones,
            'valuador' => $this->creadoPor->name,
            'valuador_clave' => $this->creadoPor->clave,
            'valuador_asociacion' => $this->creadoPor->asociacion,
            'bloques' => BloquesResource::collection($this->bloques),
            'predio' => new PredioApiResource($this->predio),
        ];
    }
}
