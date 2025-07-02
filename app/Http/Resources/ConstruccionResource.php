<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstruccionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'referencia' => $this->referencia,
            'tipo' => $this->tipo,
            'uso' => $this->uso,
            'estado' => $this->estado,
            'calidad' => $this->calidad,
            'niveles' => $this->niveles,
            'superficie' => $this->superficie,
            'valor_unitario' => $this->valor_unitario,
            'valor_construccion' => $this->valor_construccion,
        ];

    }
}
