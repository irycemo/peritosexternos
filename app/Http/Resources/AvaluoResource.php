<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TerrenoResource;
use App\Http\Resources\ColindanciaResource;
use App\Http\Resources\ConstruccionResource;
use App\Http\Resources\TerrenoComunResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ConstruccionComunResource;

class AvaluoResource extends JsonResource
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
            'estado' => $this->predio->estado,
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
            'codigo_postal' => $this->predio->codigo_postal,
            'nombre_asentamiento' => $this->predio->nombre_asentamiento,
            'tipo_asentamiento' => $this->predio->tipo_asentamiento,
            'tipo_vialidad' => $this->predio->tipo_vialidad,
            'nombre_vialidad' => $this->predio->nombre_vialidad,
            'numero_exterior' => $this->predio->numero_exterior,
            'numero_exterior_2' => $this->predio->numero_exterior_2,
            'numero_interior' => $this->predio->numero_interior,
            'numero_adicional' => $this->predio->numero_adicional,
            'numero_adicional_2' => $this->predio->numero_adicional_2,
            'lote_fraccionador' => $this->predio->lote_fraccionador,
            'manzana_fraccionador' => $this->predio->manzana_fraccionador,
            'etapa_fraccionador' => $this->predio->etapa_fraccionador,
            'nombre_edificio' => $this->predio->nombre_edificio,
            'clave_edificio' => $this->predio->clave_edificio,
            'departamento_edificio' => $this->predio->departamento_edificio,
            'nombre_predio' => $this->predio->nombre_predio,
            'xutm' => $this->predio->xutm,
            'yutm' => $this->predio->yutm,
            'zutm' => $this->predio->zutm,
            'lon' => $this->predio->lon,
            'lat' => $this->predio->lat,
            'uso_1' => $this->predio->uso_1,
            'uso_2' => $this->predio->uso_2,
            'uso_3' => $this->predio->uso_3,
            'superficie_terreno' => $this->predio->superficie_terreno,
            'area_comun_terreno' => $this->predio->area_comun_terreno,
            'superficie_construccion' => $this->predio->superficie_construccion,
            'area_comun_construccion' => $this->predio->area_comun_construccion,
            'valor_total_terreno' => $this->predio->valor_total_terreno,
            'valor_total_construccion' => $this->predio->valor_total_construccion,
            'superficie_total_terreno' => $this->predio->superficie_total_terreno,
            'superficie_total_construccion' => $this->predio->superficie_total_construccion,
            'valor_catastral' => $this->predio->valor_catastral,
            'colindancias' => ColindanciaResource::collection($this->predio->colindancias),
            'terrenos' => TerrenoResource::collection($this->predio->terrenos),
            'terrenos_comun' => TerrenoComunResource::collection($this->predio->terrenosComun),
            'construcciones' => ConstruccionResource::collection($this->predio->construcciones),
            'construcciones_comun' => ConstruccionComunResource::collection($this->predio->construccionesComun),
            'predio_sgc' => $this->predio->sgc_id,
            'propietarios' => PropietariosResource::collection($this->predio->propietarios->sortBy('persona.nombre')),
            'created_at' => $this->created_at,
            'croquis' => $this->macrolocalizacion(),
            'fachada' => $this->fachada(),
            'foto2' => $this->foto2(),
            'foto3' => $this->foto3(),
            'foto4' => $this->foto4(),
            'microlocalizacion' => $this->microlocalizacion(),
            'poligonoImagen' => $this->poligonoImagen(),
            'poligonoDwg' => $this->poligonoDwg(),
        ];

    }
}
