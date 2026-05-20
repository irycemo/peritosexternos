<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BloquesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cimentacion' => $this->cimentacion,
            'estructura' => $this->estructura,
            'muros' => $this->muros,
            'entrepiso' => $this->entrepiso,
            'techo' => $this->techo,
            'plafones' => $this->plafones,
            'vidrieria' => $this->vidrieria,
            'lambrines' => $this->lambrines,
            'pisos' => $this->pisos,
            'herreria' => $this->herreria,
            'pintura' => $this->pintura,
            'carpinteria' => $this->carpinteria,
            'recubrimiento_especial' => $this->recubrimiento_especial,
            'aplanados' => $this->aplanados,
            'hidraulica' => $this->hidraulica,
            'sanitaria' => $this->sanitaria,
            'electrica' => $this->electrica,
            'gas' => $this->gas,
            'especiales' => $this->especiales,
            'uso' => $this->uso,
            'observaciones' => $this->observaciones,
        ];
    }
}
