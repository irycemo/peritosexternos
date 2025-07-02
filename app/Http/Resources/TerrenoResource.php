<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TerrenoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'superficie' => $this->superficie,
            'demerito' => $this->demerito,
            'valor_demeritado' => $this->valor_demeritado,
            'valor_unitario' => $this->valor_unitario,
            'valor_terreno' => $this->valor_terreno,
        ];

    }
}
