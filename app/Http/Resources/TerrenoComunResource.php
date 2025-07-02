<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TerrenoComunResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'area_terreno_comun' => $this->area_terreno_comun,
            'indiviso_terreno' => $this->indiviso_terreno,
            'superficie_proporcional' => $this->superficie_proporcional,
            'valor_unitario' => $this->valor_unitario,
            'valor_terreno_comun' => $this->valor_terreno_comun,
        ];

    }
}
