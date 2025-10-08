<?php

namespace App\Traits;

use App\Models\Avaluo;
use App\Models\FirmaElectronica;
use Illuminate\Support\Facades\Storage;

trait AvaluoCadenaTrait
{

    public function crearCadena(Avaluo $avaluo):object
    {

        $terrenos = collect();

        $avaluo->predio->load('terrenos');

        foreach ($avaluo->predio->terrenos as $terreno) {

            $item = (object)[];

            $item->superficie = $terreno->superficie;
            $item->demerito = $terreno->demerito;
            $item->valor_demeritado = $terreno->valor_demeritado;
            $item->valor_unitario = $terreno->valor_unitario;
            $item->valor_terreno = $terreno->valor_terreno;

            $terrenos->push($item);

        }

        $terrenosComun = collect();

        $avaluo->predio->load('terrenosComun');

        foreach ($avaluo->predio->terrenosComun as $terrenoComun) {

            $item = (object)[];

            $item->area_terreno_comun = $terrenoComun->area_terreno_comun;
            $item->indiviso_terreno = $terrenoComun->indiviso_terreno;
            $item->valor_unitario = $terrenoComun->valor_unitario;
            $item->superficie_proporcional = $terrenoComun->superficie_proporcional;
            $item->valor_terreno_comun = $terrenoComun->valor_terreno_comun;

            $terrenosComun->push($item);

        }

        $construcciones = collect();

        $avaluo->predio->load('construcciones');

        foreach ($avaluo->predio->construcciones as $construccion) {

            $item = (object)[];

            $item->referencia = $construccion->referencia;
            $item->superficie = $construccion->superficie;
            $item->valor_unitario = $construccion->valor_unitario;
            $item->valor_construccion = $construccion->valor_construccion;

            $construcciones->push($item);

        }

        $construccionesComun = collect();

        $avaluo->predio->load('construccionesComun');

        foreach ($avaluo->predio->construccionesComun as $construccionComun) {

            $item = (object)[];

            $item->area_comun_construccion = $construccionComun->area_comun_construccion;
            $item->superficie_proporcional = $construccionComun->superficie_proporcional;
            $item->indiviso_construccion = $construccionComun->indiviso_construccion;
            $item->valor_clasificacion_construccion = $construccionComun->valor_clasificacion_construccion;
            $item->valor_construccion_comun = $construccionComun->valor_construccion_comun;

            $construccionesComun->push($item);

        }

        $colindancias = collect();

        $avaluo->predio->load('colindancias');

        foreach ($avaluo->predio->colindancias as $colindancia) {

            $item = (object)[];

            $item->viento = $colindancia->viento;
            $item->longitud = $colindancia->longitud;
            $item->descripcion = $colindancia->descripcion;

            $colindancias->push($item);

        }

        $propietarios = collect();

        $avaluo->predio->load('propietarios.persona');

        foreach ($avaluo->predio->propietarios->sortBy('persona.nombre') as $propietario) {

            $item = (object)[];

            $item->nombre = $propietario->persona->nombre;
            $item->ap_paterno = $propietario->persona->ap_paterno;
            $item->ap_materno = $propietario->persona->ap_materno;
            $item->multiple_nombre = $propietario->persona->multiple_nombre;
            $item->razon_social = $propietario->persona->razon_social;
            $item->porcentaje_propiedad = $propietario->porcentaje_propiedad;
            $item->porcentaje_nuda = $propietario->porcentaje_nuda;
            $item->porcentaje_usufructo = $propietario->porcentaje_usufructo;

            $propietarios->push($item);

        }

        $bloques = collect();

        $avaluo->load('bloques');

        foreach ($avaluo->bloques as $bloque) {

            $item = (object)[];

            $item->cimentacion = $bloque->cimentacion;
            $item->estructura = $bloque->estructura;
            $item->muros = $bloque->muros;
            $item->entrepiso = $bloque->entrepiso;
            $item->techo = $bloque->techo;
            $item->plafones = $bloque->plafones;
            $item->vidrieria = $bloque->vidrieria;
            $item->lambrines = $bloque->lambrines;
            $item->pisos = $bloque->pisos;
            $item->herreria = $bloque->herreria;
            $item->pintura = $bloque->pintura;
            $item->carpinteria = $bloque->carpinteria;
            $item->recubrimiento_especial = $bloque->recubrimiento_especial;
            $item->aplanados = $bloque->aplanados;
            $item->hidraulica = $bloque->hidraulica;
            $item->sanitaria = $bloque->sanitaria;
            $item->electrica = $bloque->electrica;
            $item->gas = $bloque->gas;
            $item->especiales = $bloque->especiales;
            $item->uso = $bloque->uso;

            $bloques->push($item);

        }

        $predio = (object)[];

        $predio->cuenta_predial = $avaluo->predio->cuentaPredial();
        $predio->clave_catastral = $avaluo->predio->claveCatastral();
        $predio->id = $avaluo->predio->id;
        $predio->tipo_predio = $avaluo->predio->tipo_predio;
        $predio->status = $avaluo->predio->status;
        $predio->curt = $avaluo->predio->curt;
        $predio->superficie_construccion = $avaluo->predio->superficie_construccion;
        $predio->area_comun_terreno = $avaluo->predio->area_comun_terreno;
        $predio->area_comun_construccion = $avaluo->predio->area_comun_construccion;
        $predio->valor_terreno_comun = $avaluo->predio->valor_terreno_comun;
        $predio->valor_construccion_comun = $avaluo->predio->valor_construccion_comun;
        $predio->valor_total_terreno = $avaluo->predio->valor_total_terreno;
        $predio->valor_total_construccion = $avaluo->predio->valor_total_construccion;
        $predio->valor_catastral = $avaluo->predio->valor_catastral;
        $predio->tipo_vialidad = $avaluo->predio->tipo_vialidad;
        $predio->tipo_asentamiento = $avaluo->predio->tipo_asentamiento;
        $predio->nombre_vialidad = $avaluo->predio->nombre_vialidad;
        $predio->nombre_asentamiento = $avaluo->predio->nombre_asentamiento;
        $predio->numero_exterior = $avaluo->predio->numero_exterior;
        $predio->numero_exterior_2 = $avaluo->predio->numero_exterior_2;
        $predio->numero_adicional = $avaluo->predio->numero_adicional;
        $predio->numero_adicional_2 = $avaluo->predio->numero_adicional_2;
        $predio->numero_interior = $avaluo->predio->numero_interior;
        $predio->manzana = $avaluo->predio->manzana;
        $predio->codigo_postal = $avaluo->predio->codigo_postal;
        $predio->lote_fraccionador = $avaluo->predio->lote_fraccionador;
        $predio->manzana_fraccionador = $avaluo->predio->manzana_fraccionador;
        $predio->etapa_fraccionador = $avaluo->predio->etapa_fraccionador;
        $predio->nombre_edificio = $avaluo->predio->nombre_edificio;
        $predio->clave_edificio = $avaluo->predio->clave_edificio;
        $predio->departamento_edificio = $avaluo->predio->departamento_edificio;
        $predio->nombre_predio = $avaluo->predio->nombre_predio;
        $predio->estado = $avaluo->predio->estado;
        $predio->municipio = $avaluo->predio->municipio;
        $predio->localidad = $avaluo->predio->localidad;
        $predio->xutm = $avaluo->predio->xutm;
        $predio->yutm = $avaluo->predio->yutm;
        $predio->zutm = $avaluo->predio->zutm;
        $predio->lon = $avaluo->predio->lon;
        $predio->lat = $avaluo->predio->lat;
        $predio->observaciones = $avaluo->predio->observaciones;
        $predio->colindancias = $colindancias;
        $predio->propietarios = $propietarios;
        $predio->terrenos = $terrenos;
        $predio->terrenosComun = $terrenosComun;
        $predio->construcciones = $construcciones;
        $predio->construccionesComun = $construccionesComun;
        $predio->ubicacion_en_manzana  = $avaluo->predio->ubicacion_en_manzana;
        $predio->superficie_terreno = $avaluo->predio->superficie_terreno;
        $predio->superficie_notarial = $avaluo->predio->superficie_notarial;
        $predio->superficie_judicial = $avaluo->predio->superficie_judicial;
        $predio->superficie_total_construccion = $avaluo->predio->superficie_total_construccion;
        $predio->superficie_total_terreno = $avaluo->predio->superficie_total_terreno;

        $object = (object)[];

        $object->año = $avaluo->año;
        $object->folio = $avaluo->folio;
        $object->usuario = $avaluo->usuario;
        $object->clasificacion_zona = $avaluo->clasificacion_zona;
        $object->construccion_dominante = $avaluo->construccion_dominante;
        $object->agua = $avaluo->agua;
        $object->drenaje = $avaluo->drenaje;
        $object->pavimento = $avaluo->pavimento;
        $object->energia_electrica = $avaluo->energia_electrica;
        $object->alumbrado_publico = $avaluo->alumbrado_publico;
        $object->banqueta = $avaluo->banqueta;
        $object->observaciones = $avaluo->observaciones;
        $object->predio = $predio;
        $object->bloques = $bloques;

        return $object;

    }

    public function convertirABase64($url):string
    {

        $path = parse_url($url, PHP_URL_PATH);

        $path_info = pathinfo($path);

        $extension = $path_info['extension'];

        $image = file_get_contents($url);

        return 'data:image/' . $extension . ';base64,' . base64_encode($image);

    }

    public function resetCaratula(Avaluo $avaluo){

        $firmas = FirmaElectronica::with('avaluo')->where('avaluo_id', $avaluo->id)->get();

        foreach ($firmas as $firma) {

            if($firma->estado == 'activo'){

                $firma->update(['estado' => 'cancelado']);

                foreach($firma->avaluo->imagenes as $imagen){

                    if($imagen->descripcion == 'avaluo'){

                        if(app()->isProduction()){

                            Storage::disk('s3')->delete($imagen->url);

                        }else{

                            Storage::disk('caratulas')->delete($imagen->url);

                        }

                        $imagen->delete();

                    }

                }

            }

        }

    }

}
