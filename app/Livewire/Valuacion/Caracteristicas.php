<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Bloque;
use App\Models\Predio;
use Livewire\Component;
use App\Constantes\Constantes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Caracteristicas extends Component
{

    public Predio $predio;
    public Avaluo $avaluo;
    public $avaluo_id;

    public $zonas;
    public $construcciones;
    public $cimentaciones;
    public $estructuras;
    public $muros;
    public $entrepisos;
    public $techos;
    public $plafones;
    public $vidrieria;
    public $lambrines;
    public $pisos;
    public $herreria;
    public $pintura;
    public $carpinteria;
    public $aplanados;
    public $rec_especial;
    public $hidraulica;
    public $sanitaria;
    public $electrica;
    public $gas;
    public $especiales;
    public $usos;
    public $ubicaciones;

    public $bloques = [];

    protected $listeners = ['cargarAvaluo'];

    protected function rules(){
        return [
            'avaluo' => 'required',
            'avaluo.clasificacion_zona' => 'required',
            'avaluo.construccion_dominante' => 'required',
            'avaluo.agua' => 'nullable',
            'avaluo.drenaje' => 'nullable',
            'avaluo.pavimento' => 'nullable',
            'avaluo.energia_electrica' => 'nullable',
            'avaluo.alumbrado_publico' => 'nullable',
            'avaluo.banqueta' => 'nullable',
            'bloques' => ['array', Rule::requiredIf($this->avaluo->construccion_dominante !== 'SIN CONSTRUCCIÓN')],
            'bloques.*.cimentacion' => 'required',
            'bloques.*.estructura' => 'required',
            'bloques.*.muros' => 'required',
            'bloques.*.entrepiso' => 'required',
            'bloques.*.techo' => 'required',
            'bloques.*.plafones' => 'required',
            'bloques.*.vidrieria' => 'required',
            'bloques.*.lambrines' => 'required',
            'bloques.*.pisos' => 'required',
            'bloques.*.herreria' => 'required',
            'bloques.*.pintura' => 'required',
            'bloques.*.carpinteria' => 'required',
            'bloques.*.recubrimiento_especial' => 'required',
            'bloques.*.aplanados' => 'required',
            'bloques.*.hidraulica' => 'required',
            'bloques.*.sanitaria' => 'required',
            'bloques.*.electrica' => 'required',
            'bloques.*.gas' => 'required',
            'bloques.*.especiales' => 'required',
            'bloques.*.uso' => 'required',
            'predio' => 'required',
            'predio.ubicacion_en_manzana' => 'required',
         ];
    }

    protected $messages = [
        'predio.required' => 'Primero debe cargar el avaluo',
        /* 'bloques.required' => 'Debe haber al menos un bloque' */
    ];

    protected $validationAttributes  = [
        'avaluo.clasificacion_zona' => 'clasificación de la zona',
        'avaluo.construccion_dominante' => 'tipo de construcción dominante',
        'predio.ubicacion_en_manzana' => 'ubicación en manzana',
        'bloques.*.uso' => 'El uso del bloque :position',
        'bloques.*.cimentacion' => 'cimentación del bloque :position',
        'bloques.*.estructura' => 'estructura del bloque :position',
        'bloques.*.muros' => 'muros del bloque :position',
        'bloques.*.entrepiso' => 'entrepiso del bloque :position',
        'bloques.*.techo' => 'techo del bloque :position',
        'bloques.*.plafones' => 'plafones del bloque :position',
        'bloques.*.vidrieria' => 'vidrieria del bloque :position',
        'bloques.*.lambrines' => 'lambrines del bloque :position',
        'bloques.*.pisos' => 'pisos del bloque :position',
        'bloques.*.herreria' => 'herreria del bloque :position',
        'bloques.*.pintura' => 'pintura del bloque :position',
        'bloques.*.carpinteria' => 'carpinteria del bloque :position',
        'bloques.*.recubrimiento_especial' => 'recubrimiento_especial del bloque :position',
        'bloques.*.aplanados' => 'aplanados del bloque :position',
        'bloques.*.hidraulica' => 'hidraulica del bloque :position',
        'bloques.*.sanitaria' => 'sanitaria del bloque :position',
        'bloques.*.electrica' => 'electrica del bloque :position',
        'bloques.*.gas' => 'gas del bloque :position',
        'bloques.*.especiales' => 'especiales del bloque :position',
    ];

    public function agregarBloque(){

        $this->bloques[] = ['id' => null, 'uso' => null, 'cimentacion' => null, 'estructura' => null, 'muros' => null, 'entrepiso' => null, 'techo' => null, 'plafones' => null, 'vidrieria' => null, 'lambrines' => null, 'pisos' => null, 'herreria' => null, 'pintura' => null, 'carpinteria' => null, 'recubrimiento_especial' => null, 'aplanados' => null, 'hidraulica' => null, 'sanitaria' => null, 'electrica' => null, 'gas' => null, 'especiales' => null];

    }

    public function borrarBloque($index){

        unset($this->bloques[$index]);

        $this->bloques = array_values($this->bloques);

    }

    public function cargarBloques($avaluo){

        $this->reset('bloques');

        $avaluo->load('bloques');

        foreach ($avaluo->bloques as $bloque) {

            $this->bloques[] = [
                'id' => $bloque->id,
                'uso' => $bloque->uso,
                'cimentacion' => $this->stringToArray($bloque->cimentacion),
                'estructura' => $this->stringToArray($bloque->estructura),
                'muros' => $this->stringToArray($bloque->muros),
                'entrepiso' => $this->stringToArray($bloque->entrepiso),
                'techo' => $this->stringToArray($bloque->techo),
                'plafones' => $this->stringToArray($bloque->plafones),
                'vidrieria' => $this->stringToArray($bloque->vidrieria),
                'lambrines' => $this->stringToArray($bloque->lambrines),
                'pisos' => $this->stringToArray($bloque->pisos),
                'herreria' => $this->stringToArray($bloque->herreria),
                'pintura' => $this->stringToArray($bloque->pintura),
                'carpinteria' => $this->stringToArray($bloque->carpinteria),
                'recubrimiento_especial' => $this->stringToArray($bloque->recubrimiento_especial),
                'aplanados' => $this->stringToArray($bloque->aplanados),
                'hidraulica' => $this->stringToArray($bloque->hidraulica),
                'sanitaria' => $this->stringToArray($bloque->sanitaria),
                'electrica' => $this->stringToArray($bloque->electrica),
                'gas' => $this->stringToArray($bloque->gas),
                'especiales' => $this->stringToArray($bloque->especiales),
            ];

        }

    }

    public function guardarBloques($avaluo){

        $ids = collect($this->bloques)->whereNotNull('id')->pluck('id');

        if(count($ids) == 0){

            $bloquesBorrar = $avaluo->bloques()->delete();

        }else{

            $bloquesBorrar = $avaluo->bloques()->whereNotIn('id', $ids)->get();

            foreach ($bloquesBorrar as $bloque) {

                $bloque->delete();

            }

        }

        foreach ($this->bloques as $key =>$bloque) {

            if($bloque['id'] == null){

                $aux = $avaluo->bloques()->create([
                    'uso' => $bloque['uso'],
                    'cimentacion' => $this->arrayToString($bloque['cimentacion']),
                    'estructura' => $this->arrayToString($bloque['estructura']),
                    'muros' => $this->arrayToString($bloque['muros']),
                    'entrepiso' => $this->arrayToString($bloque['entrepiso']),
                    'techo' => $this->arrayToString($bloque['techo']),
                    'plafones' => $this->arrayToString($bloque['plafones']),
                    'vidrieria' => $this->arrayToString($bloque['vidrieria']),
                    'lambrines' => $this->arrayToString($bloque['lambrines']),
                    'pisos' => $this->arrayToString($bloque['pisos']),
                    'herreria' => $this->arrayToString($bloque['herreria']),
                    'pintura' => $this->arrayToString($bloque['pintura']),
                    'carpinteria' => $this->arrayToString($bloque['carpinteria']),
                    'recubrimiento_especial' => $this->arrayToString($bloque['recubrimiento_especial']),
                    'aplanados' => $this->arrayToString($bloque['aplanados']),
                    'hidraulica' => $this->arrayToString($bloque['hidraulica']),
                    'sanitaria' => $this->arrayToString($bloque['sanitaria']),
                    'electrica' => $this->arrayToString($bloque['electrica']),
                    'gas' => $this->arrayToString($bloque['gas']),
                    'especiales' => $this->arrayToString($bloque['especiales']),
                ]);

                $this->bloques[$key]['id'] = $aux->id;

            }else{

                Bloque::find($bloque['id'])->update([
                    'uso' => $bloque['uso'],
                    'cimentacion' => $this->arrayToString($bloque['cimentacion']),
                    'estructura' => $this->arrayToString($bloque['estructura']),
                    'muros' => $this->arrayToString($bloque['muros']),
                    'entrepiso' => $this->arrayToString($bloque['entrepiso']),
                    'techo' => $this->arrayToString($bloque['techo']),
                    'plafones' => $this->arrayToString($bloque['plafones']),
                    'vidrieria' => $this->arrayToString($bloque['vidrieria']),
                    'lambrines' => $this->arrayToString($bloque['lambrines']),
                    'pisos' => $this->arrayToString($bloque['pisos']),
                    'herreria' => $this->arrayToString($bloque['herreria']),
                    'pintura' => $this->arrayToString($bloque['pintura']),
                    'carpinteria' => $this->arrayToString($bloque['carpinteria']),
                    'recubrimiento_especial' => $this->arrayToString($bloque['recubrimiento_especial']),
                    'aplanados' => $this->arrayToString($bloque['aplanados']),
                    'hidraulica' => $this->arrayToString($bloque['hidraulica']),
                    'sanitaria' => $this->arrayToString($bloque['sanitaria']),
                    'electrica' => $this->arrayToString($bloque['electrica']),
                    'gas' => $this->arrayToString($bloque['gas']),
                    'especiales' => $this->arrayToString($bloque['especiales']),
                    'avaluo_id' => $avaluo->id
                ]);

            }

        }

    }

    public function arrayToString($array){

        return implode(', ', array_values($array));

    }

    public function stringToArray($string){

        $array_original =  explode(",", $string);

        $solo_valores = array_values($array_original);

        return array_map('trim', $solo_valores);

    }

    public function copiarBloques($avaluo, $id){

        foreach ($avaluo->bloques as $bloque) {

            $bloque->update(['avaluo_id' => $id]);

        }

        $this->cargarBloques($avaluo);

    }

    public function cargarAvaluo($id){

        $this->avaluo = Avaluo::find($id);

        $this->cargarBloques($this->avaluo);

    }

    public function revisarDemerito(){

        $demerito = 30;

        if($this->avaluo->agua){

            $demerito = $demerito - 5;

        }

        if($this->avaluo->drenaje){

            $demerito = $demerito - 5;

        }

        if($this->avaluo->pavimento){

            $demerito = $demerito - 5;

        }

        if($this->avaluo->energia_electrica){

            $demerito = $demerito - 5;

        }

        if($this->avaluo->alumbrado_publico){

            $demerito = $demerito - 5;

        }

        if($this->avaluo->banqueta){

            $demerito = $demerito - 5;

        }

        $this->dispatch('valorDemerito', $demerito);

    }

    public function guardar(){

        $this->validate();

        try {

            DB::transaction(function () {

                $this->avaluo->actualizado_por = auth()->id();

                $this->avaluo->save();

                $this->predio->save();

                $this->guardarBloques($this->avaluo);

                $this->avaluo->audits()->latest()->first()->update(['tags' => 'Actualizó caracteristicas']);

            });

            $this->dispatch('mostrarMensaje', ['success', "Las características se guardaron con éxito"]);

            /* $this->revisarDemerito(); */

        } catch (\Throwable $th) {

            Log::error("Error al crear caracteristicas por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function mount(){

        $this->zonas = Constantes::CLASIFICACION_ZONA;

        $this->construcciones = Constantes::CONSTRUCCION_DOMINANTE;

        $this->cimentaciones = Constantes::CIMENTACION;

        $this->estructuras = Constantes::ESTRUCTURAS;

        $this->muros = Constantes::MUROS;

        $this->entrepisos = Constantes::ENTREPISOS;

        $this->techos = Constantes::TECHOS;

        $this->plafones = Constantes::PLAFONES;

        $this->vidrieria = Constantes::VIDRIERIA;

        $this->lambrines = Constantes::LAMBRINES;

        $this->pisos = Constantes::PISOS;

        $this->herreria = Constantes::HERRERIA;

        $this->pintura = Constantes::PINTURA;

        $this->carpinteria = Constantes::CARPINTERIA;

        $this->aplanados = Constantes::APLANADOS;

        $this->rec_especial = Constantes::RECUBRIMIENTO_ESPECIAL;

        $this->hidraulica = Constantes::HIDRAULICA;

        $this->sanitaria = Constantes::SANITARIA;

        $this->electrica = Constantes::ELECTRICA;

        $this->gas = Constantes::GAS;

        $this->especiales = Constantes::ESPECIALES;

        $this->usos = Constantes::USO_PREDIO;

        $this->ubicaciones = Constantes::UBICACION_PREDIO;

        if($this->avaluo_id){

            $this->avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->predio = $this->avaluo->predio;

        }else{

            $this->avaluo = Avaluo::make();
        }

    }

    public function render()
    {
        return view('livewire.valuacion.caracteristicas');
    }
}
