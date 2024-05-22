<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use App\Constantes\Constantes;
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

    protected $listeners = ['cargarPredio'];

    protected function rules(){
        return [
            'avaluo' => 'required',
            'avaluo.clasificacion_zona' => 'required',
            'avaluo.construccion_dominante' => 'nullable',
            'avaluo.agua' => 'nullable',
            'avaluo.drenaje' => 'nullable',
            'avaluo.pavimento' => 'nullable',
            'avaluo.energia_electrica' => 'nullable',
            'avaluo.alumbrado_publico' => 'nullable',
            'avaluo.banqueta' => 'nullable',
            'avaluo.cimentacion' => 'required',
            'avaluo.estructura' => 'required',
            'avaluo.muros' => 'required',
            'avaluo.entrepiso' => 'required',
            'avaluo.techo' => 'required',
            'avaluo.plafones' => 'required',
            'avaluo.vidrieria' => 'required',
            'avaluo.lambrines' => 'required',
            'avaluo.pisos' => 'required',
            'avaluo.herreria' => 'required',
            'avaluo.pintura' => 'required',
            'avaluo.carpinteria' => 'required',
            'avaluo.recubrimiento_especial' => 'required',
            'avaluo.aplanados' => 'required',
            'avaluo.hidraulica' => 'required',
            'avaluo.sanitaria' => 'required',
            'avaluo.electrica' => 'required',
            'avaluo.gas' => 'required',
            'avaluo.especiales' => 'required',
            'predio' => 'required'
         ];
    }

    protected $messages = [
        'predio.required' => '. Primero debe cargar el avaluo',

    ];

    protected $validationAttributes  = [
        'avaluo.clasificacion_zona' => 'clasificación de la zona',
        'avaluo.construccion_dominante' => 'tipo de construcción dominante'
    ];

    public function cargarPredio($id){

        $this->predio = Predio::with('avaluo')->find($id);

        $this->avaluo = $this->predio->avaluo;

        $this->avaluo->construccion_dominante = $this->avaluo->construccion_dominante ?? 'NO APLICA';
        $this->avaluo->cimentacion = $this->avaluo->cimentacion ?? 'NO APLICA';
        $this->avaluo->estructura = $this->avaluo->estructura ?? 'NO APLICA';
        $this->avaluo->muros = $this->avaluo->muros ?? 'NO APLICA';
        $this->avaluo->entrepiso = $this->avaluo->entrepiso ?? 'NO APLICA';
        $this->avaluo->techo = $this->avaluo->techo ?? 'NO APLICA';
        $this->avaluo->plafones = $this->avaluo->plafones ?? 'NO APLICA';
        $this->avaluo->vidrieria = $this->avaluo->vidrieria ?? 'NO APLICA';
        $this->avaluo->lambrines = $this->avaluo->lambrines ?? 'NO APLICA';
        $this->avaluo->pisos = $this->avaluo->pisos ?? 'NO APLICA';
        $this->avaluo->herreria = $this->avaluo->herreria ?? 'NO APLICA';
        $this->avaluo->pintura = $this->avaluo->pintura ?? 'NO APLICA';
        $this->avaluo->carpinteria = $this->avaluo->carpinteria ?? 'NO APLICA';
        $this->avaluo->recubrimiento_especial = $this->avaluo->recubrimiento_especial ?? 'NO APLICA';
        $this->avaluo->aplanados = $this->avaluo->aplanados ?? 'NO APLICA';
        $this->avaluo->hidraulica = $this->avaluo->hidraulica ?? 'NO APLICA';
        $this->avaluo->sanitaria = $this->avaluo->sanitaria ?? 'NO APLICA';
        $this->avaluo->electrica = $this->avaluo->electrica ?? 'NO APLICA';
        $this->avaluo->gas = $this->avaluo->gas ?? 'NO APLICA';
        $this->avaluo->especiales = $this->avaluo->especiales ?? 'NO APLICA';

    }

    public function guardar(){

        $this->authorize('update', $this->predio->avaluo);

        $this->validate();

        try {

            $this->avaluo->actualizado_por = auth()->user()->id;
            $this->avaluo->estado = 'nuevo';
            $this->avaluo->save();

            $this->dispatch('mostrarMensaje', ['success', "Las caracteristicas se guardaron con éxito"]);

            $this->dispatch('cargarPredio', $this->predio->id);

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

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->cargarPredio($avaluo->predio->id);

        }else{

            $this->avaluo = Avaluo::make();
        }

    }

    public function render()
    {
        return view('livewire.valuacion.caracteristicas');
    }

}
