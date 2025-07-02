<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstruccionComunResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'area_comun_construccion' => $this->area_comun_construccion,
            'indiviso_construccion' => $this->indiviso_construccion,
            'superficie_proporcional' => $this->superficie_proporcional,
            'valor_clasificacion_construccion' => $this->valor_clasificacion_construccion,
            'valor_construccion_comun' => $this->valor_construccion_comun,
        ];

    }
}
