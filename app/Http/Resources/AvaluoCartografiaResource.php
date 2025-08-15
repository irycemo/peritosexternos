<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvaluoCartografiaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'año' => $this->año,
            'folio' => $this->folio,
            'usuario' => $this->usuario,
            'cartografia' => $this->poligonoDwg(),
            'valuador' => $this->creadoPor->name
        ];

    }
}
