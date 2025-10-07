<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvaluosConcilarResource extends JsonResource
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
            'valuador' => $this->creadoPor->name,
            'cuenta_predial' => $this->predio->cuentaPredial(),
            'clave_catastral' => $this->predio->claveCatastral(),
            'lat' => $this->predio->lat,
            'lon' => $this->predio->lon,
            'region_catastral' => $this->predio->region_catastral,
            'municipio' => $this->predio->municipio,
            'zona_catastral' => $this->predio->zona_catastral,
            'localidad' => $this->predio->localidad,
            'sector' => $this->predio->sector,
            'manzana' => $this->predio->manzana,
            'predio' => $this->predio->predio,
            'edificio' => $this->predio->edificio,
            'departamento' => $this->predio->departamento,
            'oficina' => $this->predio->oficina,
            'tipo_predio' => $this->predio->tipo_predio,
            'numero_registro' => $this->predio->numero_registro,
        ];
    }
}
