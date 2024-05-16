<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Predio;
use App\Models\Terreno;
use Livewire\Component;
use App\Models\Construccion;
use App\Constantes\Constantes;
use Illuminate\Validation\Rule;
use App\Models\Condominioterreno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Condominiocontruccion;
use App\Models\ValoresUnitariosRusticos;
use App\Models\ValoresUnitariosContruccion;

class Valor extends Component
{

    public $avaluo_id;

    public $usos;
    public $ubicaciones;
    public $terrenos = [];
    public $construcciones = [];
    public $construccionesCondominio = [];
    public $terrenosCondominio = [];
    public $valores_rusticos;
    public $valores_construccion;
    public $porcentajeDemerito;

    public Avaluo $avaluo;

    public Predio $predio;

    protected $listeners = ['cargarPredio'];

    protected function rules(){
        return [
            'predio.uso_1' => 'required',
            'predio.uso_2' => 'nullable',
            'predio.uso_3' => 'nullable',
            'predio.superficie_terreno' => 'nullable',
            'predio.superficie_construccion' => 'nullable',
            'predio.ubicacion_en_manzana' => 'required',
            'predio.valor_catastral' => 'nullable',
            'predio' => 'required',
            'predio.area_comun_terreno' => 'nullable',
            'predio.valor_terreno_comun' => 'nullable',
            'predio.valor_construccion_comun' => 'nullable',
         ];
    }

    protected $messages = [
        'predio.required' => '. Primero debe cargar el avaluo'
    ];

    protected $validationAttributes  = [
        'terrenos.*.superficie' => 'superficie',
        'terrenos.*.valor_unitario' => 'valor unitario',
        'construcciones.*.referencia' => 'referencia',
        'construcciones.*.valor_unitario' => 'valor unitario',
        'construcciones.*.niveles' => 'niveles',
        'construcciones.*.superficie' => 'superficie',
        'predio.uso_1' => 'uso de predio',
        'predio.ubicacion_en_manzana' => 'ubicación en manzana',
        'construccionesCondominio.*.area_comun_construccion' => 'área común de construcción',
        'construccionesCondominio.*.indiviso_construccion' => 'indiviso de construcción',
        'terrenosCondominio.*.area_terreno_comun' => 'área de terreno común',
        'terrenosCondominio.*.indiviso_terreno' => 'indiviso de terreno',
        'terrenosCondominio.*.valor_unitario' => 'valor unitario',
        'construccionesCondominio.*.valor_clasificacion_construccion' => 'valor de clasificación',
    ];

    public function updatedTerrenos($value, $index){

        $this->validate(['predio' => 'required']);

        $i = explode('.', $index);

        if(isset($this->terrenos[$i[0]]['demerito']) && $this->terrenos[$i[0]]['demerito'] == 0){

            $this->terrenos[$i[0]]['valor_demeritado'] = 0;

        }

        if(isset($this->terrenos[$i[0]]['superficie']) && isset($this->terrenos[$i[0]]['valor_unitario']) && isset($this->terrenos[$i[0]]['demerito']) && $this->terrenos[$i[0]]['demerito'] != 0){

            $this->terrenos[$i[0]]['valor_demeritado'] = (float)$this->terrenos[$i[0]]['valor_unitario'] - (float)$this->terrenos[$i[0]]['valor_unitario'] * (float)$this->terrenos[$i[0]]['demerito'] / 100;

            if($this->predio->tipo_predio == 2){

                $this->terrenos[$i[0]]['valor_terreno'] = (float)$this->terrenos[$i[0]]['superficie'] * (float)$this->terrenos[$i[0]]['valor_demeritado'] / 10000;

            }else{

                $this->terrenos[$i[0]]['valor_terreno'] = (float)$this->terrenos[$i[0]]['superficie'] * (float)$this->terrenos[$i[0]]['valor_demeritado'];
            }


        }elseif(isset($this->terrenos[$i[0]]['superficie']) && isset($this->terrenos[$i[0]]['valor_unitario'])){

            $this->terrenos[$i[0]]['valor_terreno'] = (float)$this->terrenos[$i[0]]['superficie'] * (float)$this->terrenos[$i[0]]['valor_unitario'];

            if($this->predio->tipo_predio == 2)
                $this->terrenos[$i[0]]['valor_terreno'] = $this->terrenos[$i[0]]['valor_terreno'] / 10000;

        }

    }

    public function updatedConstrucciones($value, $index){

        $i = explode('.', $index);

        if($i[1] == 'valores'){

            if($this->construcciones[$i[0]]['valores'] === "" ){

                $this->construcciones[$i[0]]['uso'] = null;

                $this->construcciones[$i[0]]['tipo'] = null;

                $this->construcciones[$i[0]]['estado'] = null;

                $this->construcciones[$i[0]]['calidad'] = null;

                $this->construcciones[$i[0]]['valor_unitario'] = null;

                return;

            }

            $aux = json_decode($this->construcciones[$i[0]]['valores'], true);

            $this->construcciones[$i[0]]['uso'] = $aux['uso'];

            $this->construcciones[$i[0]]['tipo'] = $aux['tipo'];

            $this->construcciones[$i[0]]['estado'] = $aux['estado'];

            $this->construcciones[$i[0]]['calidad'] = $aux['calidad'];

            $this->construcciones[$i[0]]['valor_unitario'] = $aux['valor'];

        }

        if(isset($this->construcciones[$i[0]]['valor_unitario']) && isset($this->construcciones[$i[0]]['superficie'])){

            $this->construcciones[$i[0]]['valor_construccion'] = (float)$this->construcciones[$i[0]]['valor_unitario'] * (float)$this->construcciones[$i[0]]['superficie'];

        }


    }

    public function updatedTerrenosCondominio($value, $index){

        $i = explode('.', $index);

        if(isset($this->terrenosCondominio[$i[0]]['indiviso_terreno'])){

            if(!is_numeric($this->terrenosCondominio[$i[0]]['indiviso_terreno']) || $this->terrenosCondominio[$i[0]]['indiviso_terreno'] > 100 || $this->terrenosCondominio[$i[0]]['indiviso_terreno'] < 0){

                $this->terrenosCondominio[$i[0]]['indiviso_terreno'] = 0;

                return;

            }

            $this->terrenosCondominio[$i[0]]['indiviso_terreno'] = round($this->terrenosCondominio[$i[0]]['indiviso_terreno'], 4);

        }

        if(isset($this->terrenosCondominio[$i[0]]['area_terreno_comun']) &&
            isset($this->terrenosCondominio[$i[0]]['indiviso_terreno']) &&
            isset($this->terrenosCondominio[$i[0]]['valor_unitario']))
        {

            $this->terrenosCondominio[$i[0]]['valor_terreno_comun'] = (float)$this->terrenosCondominio[$i[0]]['area_terreno_comun'] *
                                                                                    (float)$this->terrenosCondominio[$i[0]]['indiviso_terreno'] *
                                                                                    (float)$this->terrenosCondominio[$i[0]]['valor_unitario'] ;

        }

    }

    public function updatedConstruccionesCondominio($value, $index){

        $i = explode('.', $index);

        if(isset($this->construccionesCondominio[$i[0]]['indiviso_construccion'])){

            if(!is_numeric($this->construccionesCondominio[$i[0]]['indiviso_construccion']) || $this->construccionesCondominio[$i[0]]['indiviso_construccion'] > 100 || $this->construccionesCondominio[$i[0]]['indiviso_construccion'] < 0){

                $this->construccionesCondominio[$i[0]]['indiviso_construccion'] = 0;

                return;

            }

            $this->construccionesCondominio[$i[0]]['indiviso_construccion'] = round($this->construccionesCondominio[$i[0]]['indiviso_construccion'], 4);

        }

        if(isset($this->construccionesCondominio[$i[0]]['area_comun_construccion']) &&
            isset($this->construccionesCondominio[$i[0]]['indiviso_construccion']) &&
            isset($this->construccionesCondominio[$i[0]]['valor_clasificacion_construccion']))
        {

            $this->construccionesCondominio[$i[0]]['valor_construccion_comun'] = (float)$this->construccionesCondominio[$i[0]]['area_comun_construccion'] *
                                                                                    (float)$this->construccionesCondominio[$i[0]]['indiviso_construccion'] *
                                                                                    (float)$this->construccionesCondominio[$i[0]]['valor_clasificacion_construccion'] ;

        }

    }

    public function cargarPredio($id){

        $this->reset(['terrenos', 'construcciones', 'terrenosCondominio', 'construccionesCondominio']);

        $this->predio = Predio::with('avaluo')->find($id);

        foreach ($this->predio->terrenos as $terreno) {

            $this->terrenos[] = [
                'id' => $terreno->id,
                'superficie' => $terreno->superficie,
                'valor_unitario' => $terreno->valor_unitario,
                'demerito' => $terreno->demerito,
                'valor_demeritado' => $terreno->valor_demeritado,
                'valor_terreno' => $terreno->valor_terreno
            ];

        }

        foreach ($this->predio->construcciones as $construccion) {

            $this->construcciones[] = [
                'id' => $construccion->id,
                'referencia' => $construccion->referencia,
                'niveles' => $construccion->niveles,
                'superficie' => $construccion->superficie,
                'valor_unitario' => $construccion->valor_unitario,
                'tipo' => $construccion->tipo,
                'uso' => $construccion->uso,
                'calidad' => $construccion->calidad,
                'estado' => $construccion->estado,
                'valor_construccion' => $construccion->valor_construccion
            ];
        }

        foreach ($this->predio->condominioTerrenos as $terreno) {

            $this->terrenosCondominio[] = [
                'id' => $terreno->id,
                'area_terreno_comun' => $terreno->area_terreno_comun,
                'indiviso_terreno' => $terreno->indiviso_terreno,
                'valor_unitario' => $terreno->valor_unitario,
                'valor_terreno_comun' => $terreno->valor_terreno_comun,
            ];
        }

        foreach ($this->predio->condominioConstrucciones as $construccion) {

            $this->construccionesCondominio[] = [
                'id' => $construccion->id,
                'area_comun_construccion' => $construccion->area_comun_construccion,
                'indiviso_construccion' => $construccion->indiviso_construccion,
                'valor_clasificacion_construccion' => $construccion->valor_clasificacion_construccion,
                'valor_construccion_comun' => $construccion->valor_construccion_comun,
            ];
        }

        $this->avaluo = $this->predio->avaluo;

        $this->porcentajeDemerito = null;

        if(!$this->avaluo->agua)
            $this->porcentajeDemerito = 5;
        if(!$this->avaluo->drenaje)
            $this->porcentajeDemerito = $this->porcentajeDemerito + 5;
        if(!$this->avaluo->pavimento)
            $this->porcentajeDemerito = $this->porcentajeDemerito + 5;
        if(!$this->avaluo->energia_electrica)
            $this->porcentajeDemerito = $this->porcentajeDemerito + 5;
        if(!$this->avaluo->alumbrado_publico)
            $this->porcentajeDemerito = $this->porcentajeDemerito + 5;
        if(!$this->avaluo->banqueta)
            $this->porcentajeDemerito = $this->porcentajeDemerito + 5;

        foreach ($this->terrenos as $terreno) {

            $terreno['demerito'] = $this->porcentajeDemerito;

        }

        if(count($this->terrenos) == 0)
            $this->agregarTerreno();

        if(count($this->construcciones) == 0)
            $this->agregarConstruccion();

        if(count($this->terrenosCondominio) == 0)
            $this->agregarTerrenoConstruccion();

        if(count($this->construccionesCondominio) == 0)
            $this->agregarCondominioConstruccion();

    }

    public function agregarConstruccion(){

        $this->construcciones[] = ['superficie' => null, 'niveles' => null, 'referencia' => null, 'id' => null, 'valor_unitario' => null, 'valores' => null, 'uso' => null, 'tipo' => null, 'categoria' => null, 'calidad' => null,'valor_construccion' => null];

    }

    public function agregarTerreno(){

        $this->terrenos[] = ['superficie' => null, 'valor_unitario' => null, 'demerito' => $this->porcentajeDemerito, 'id' => null , 'valor_demeritado' => null, 'valor_terreno' => null];

    }

    public function agregarTerrenoConstruccion(){

        $this->terrenosCondominio[] = ['codigo' => null, 'niveles' => null, 'superficie' => null, 'id' => null, 'valor_unitario' => null, 'valores' => null, 'uso' => null, 'tipo' => null, 'categoria' => null, 'calidad' => null];

    }

    public function agregarCondominioConstruccion(){

        $this->construccionesCondominio[] = ['area_comun_construccion' => null, 'indiviso_construccion' => null, 'valor_clasificacion_construccion' => null, 'id' => null, 'valor_construccion_comun' => null,];

    }

    public function borrarConstruccion($index){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate(['predio' => 'required']);

        try {

            if($this->construcciones[$index]['id'] != null)
                $this->predio->construcciones()->where('id', $this->construcciones[$index]['id'])->delete();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar construccion por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->construcciones[$index]);

        $this->construcciones = array_values($this->construcciones);

    }

    public function borrarTerreno($index){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate(['predio' => 'required']);

        try {

            if($this->terrenos[$index]['id'] != null)
                $this->predio->terrenos()->where('id', $this->terrenos[$index]['id'])->delete();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar terreno por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->terrenos[$index]);

        $this->terrenos = array_values($this->terrenos);

    }

    public function borrarCondominioTerreno($index){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate(['predio' => 'required']);

        try {

            if($this->terrenosCondominio[$index]['id'] != null)
                $this->predio->condominioTerrenos()->where('id', $this->terrenosCondominio[$index]['id'])->delete();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar terreno de condominio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->terrenosCondominio[$index]);

        $this->terrenosCondominio = array_values($this->terrenosCondominio);

    }

    public function borrarCondominioConstruccion($index){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate(['predio' => 'required']);

        try {

            if($this->construccionesCondominio[$index]['id'] != null)
                $this->predio->condominioConstrucciones()->where('id', $this->construccionesCondominio[$index]['id'])->delete();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar terreno por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->construccionesCondominio[$index]);

        $this->construccionesCondominio = array_values($this->construccionesCondominio);

    }

    public function guardarConstrucciones(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate([
            'predio' => 'required',
            'construcciones.*'  => 'required',
            'construcciones.*.referencia' => 'required',
            'construcciones.*.valor_unitario' => 'required',
            'construcciones.*.niveles' => 'required',
            'construcciones.*.superficie' => 'required',
            'construcciones.*.tipo' => 'required',
            'construcciones.*.uso' => 'required',
            'construcciones.*.estado' => 'required',
            'construcciones.*.calidad' => 'required',
        ]);

        try {

            DB::transaction(function () {

                $sum = 0;
                $sum2 = 0;

                foreach ($this->construcciones as $key => $construccion) {

                    if($construccion['id'] == null){

                        $aux = $this->predio->construcciones()->create([
                            'referencia' => $construccion['referencia'],
                            'valor_unitario' => $construccion['valor_unitario'],
                            'niveles' => $construccion['niveles'],
                            'superficie' => $construccion['superficie'],
                            'uso' => $construccion['uso'],
                            'tipo' => $construccion['tipo'],
                            'calidad' => $construccion['calidad'],
                            'estado' => $construccion['estado'],
                            'valor_construccion' => (float)$construccion['valor_unitario'] * (float)$construccion['superficie']
                        ]);

                        $this->construcciones[$key]['id'] = $aux->id;

                    }else{

                        Construccion::find($construccion['id'])->update([
                            'referencia' => $construccion['referencia'],
                            'valor_unitario' => $construccion['valor_unitario'],
                            'niveles' => $construccion['niveles'],
                            'superficie' => $construccion['superficie'],
                            'uso' => $construccion['uso'],
                            'tipo' => $construccion['tipo'],
                            'calidad' => $construccion['calidad'],
                            'estado' => $construccion['estado'],
                            'valor_construccion' => (float)$construccion['valor_unitario'] * (float)$construccion['superficie']
                        ]);

                    }

                    $sum = $sum + (float)$construccion['valor_unitario'] * (float)$construccion['superficie'];

                    $sum2 = $sum2 + (float)$construccion['superficie'];

                }

                $this->predio->update([
                    'superficie_construccion' => $sum2,
                    'valor_total_construccion' => $sum,
                ]);

                $this->predio->avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'estado' => 'nuevo'
                ]);

                $this->dispatch('mostrarMensaje', ['success', "Las construcciones se guardaron con éxito"]);

            });

        } catch (\Throwable $th) {
            Log::error("Error al crear construccion por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function guardarTerrenos(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate([
            'predio' => 'required',
            'terrenos.*' => 'required',
            'terrenos.*.superficie' => 'required',
            'terrenos.*.valor_unitario' => 'required',
            'terrenos.*.demerito' => 'nullable|numeric|min:0',
        ]);

        try {

            DB::transaction(function () {

                $sum = 0;

                $sum2 = 0;

                foreach ($this->terrenos as $key => $terreno) {

                    if($terreno['id'] == null){

                        $aux = $this->predio->terrenos()->create([
                            'superficie' => $terreno['superficie'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'demerito' => $terreno['demerito'],
                            'valor_demeritado' => $terreno['valor_demeritado'],
                            'valor_terreno' => $terreno['valor_terreno'],
                        ]);

                        $this->terrenos[$key]['id'] = $aux->id;

                    }else{

                        Terreno::find($terreno['id'])->update([
                            'superficie' => $terreno['superficie'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'demerito' => $terreno['demerito'],
                            'valor_demeritado' => $terreno['valor_demeritado'],
                            'valor_terreno' => $terreno['valor_terreno'],
                        ]);

                    }

                    $sum = $sum + (float)$terreno['valor_terreno'];

                    $sum2 = $sum2 + (float)$terreno['superficie'];

                }

                $this->predio->update([
                    'superficie_terreno' => $sum2,
                    'valor_total_terreno' => $sum
                ]);

                $this->predio->avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'estado' => 'nuevo'
                ]);

                $this->dispatch('mostrarMensaje', ['success', "Los terrenos se guardaron con éxito"]);

            });

        } catch (\Throwable $th) {
            Log::error("Error al crear valor catastral por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function guardarTerrenosCondominio(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate([
            'predio' => 'required',
            'terrenosCondominio.*' => 'required',
            'terrenosCondominio.*.area_terreno_comun' => 'required',
            'terrenosCondominio.*.indiviso_terreno' => 'required|max:100',
            'terrenosCondominio.*.valor_unitario' => 'required',
        ]);

        if($this->revisarPorcentaje())
            return;

        try {

            DB::transaction(function () {

                $sum = 0;

                $sum2 = 0;

                foreach ($this->terrenosCondominio as $key => $terreno) {

                    if($terreno['id'] == null){

                        $aux = $this->predio->condominioTerrenos()->create([
                            'area_terreno_comun' => $terreno['area_terreno_comun'],
                            'indiviso_terreno' => $terreno['indiviso_terreno'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'valor_terreno_comun' => $terreno['valor_terreno_comun'],
                        ]);

                        $this->terrenosCondominio[$key]['id'] = $aux->id;

                    }else{

                        Condominioterreno::find($terreno['id'])->update([
                            'area_terreno_comun' => $terreno['area_terreno_comun'],
                            'indiviso_terreno' => $terreno['indiviso_terreno'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'valor_terreno_comun' => $terreno['valor_terreno_comun'],
                        ]);

                    }

                    $sum = $sum + (float)$terreno['valor_terreno_comun'];

                    $sum2 = $sum2 + (float)$terreno['area_terreno_comun'];

                }

                $this->predio->area_comun_terreno = $sum2;
                $this->predio->valor_terreno_comun = $sum;

                $this->predio->save();

                $this->predio->avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'estado' => 'nuevo'
                ]);

                $this->dispatch('mostrarMensaje', ['success', "La información de terrenos de condominio se guardó con éxito"]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar el valor de terreno condominio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function guardarCondominio(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate([
            'predio' => 'required',
            'construccionesCondominio.*' => 'required',
            'construccionesCondominio.*.area_comun_construccion' => 'required',
            'construccionesCondominio.*.indiviso_construccion' => 'required|max:100',
            'construccionesCondominio.*.valor_clasificacion_construccion' => 'required',
        ]);

        if($this->revisarPorcentaje())
            return;

        try {

            DB::transaction(function () {

                $sum = 0;

                $sum2 = 0;

                foreach ($this->construccionesCondominio as $key => $construccion) {

                    if($construccion['id'] == null){

                        $aux = $this->predio->condominioConstrucciones()->create([
                            'area_comun_construccion' => $construccion['area_comun_construccion'],
                            'indiviso_construccion' => $construccion['indiviso_construccion'],
                            'valor_clasificacion_construccion' => $construccion['valor_clasificacion_construccion'],
                            'valor_construccion_comun' => $construccion['valor_construccion_comun'],
                        ]);

                        $this->construccionesCondominio[$key]['id'] = $aux->id;

                    }else{

                        Condominiocontruccion::find($construccion['id'])->update([
                            'area_comun_construccion' => $construccion['area_comun_construccion'],
                            'indiviso_construccion' => $construccion['indiviso_construccion'],
                            'valor_clasificacion_construccion' => $construccion['valor_clasificacion_construccion'],
                            'valor_construccion_comun' => $construccion['valor_construccion_comun'],
                        ]);

                    }

                    $sum = $sum + (float)$construccion['valor_construccion_comun'];

                    $sum2 = $sum2 + (float)$construccion['area_comun_construccion'];

                }

                $this->predio->area_comun_construccion = $sum2;
                $this->predio->valor_construccion_comun = $sum;

                $this->predio->save();

                $this->predio->avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'estado' => 'nuevo'
                ]);

                $this->dispatch('mostrarMensaje', ['success', "La información de condominio se guardó con éxito"]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar el valor de condominio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function guardar(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate([
            'predio.uso_1' => 'required',
            'predio.uso_2' => 'nullable',
            'predio.uso_3' => 'nullable',
            'predio.superficie_terreno' => 'nullable',
            'predio.superficie_construccion' => 'nullable',
            'predio.ubicacion_en_manzana' => 'required',
            'predio.valor_catastral' => 'nullable',
            'predio' => 'required',
        ]);

        $this->validate([
            'predio.area_comun_terreno' => Rule::requiredIf($this->predio->edificio === 1),
            'predio.area_comun_construccion' => Rule::requiredIf($this->predio->edificio === 1),
            'predio.valor_terreno_comun' => Rule::requiredIf($this->predio->edificio === 1),
            'predio.valor_construccion_comun' => Rule::requiredIf($this->predio->edificio === 1),
        ]);

        try {

            $this->predio->valor_catastral = $this->predio->valor_total_terreno +
                                                $this->predio->valor_total_construccion +
                                                $this->predio->valor_terreno_comun +
                                                $this->predio->valor_construccion_comun;

            if($this->predio->ubicacion_en_manzana == 'ESQUINA'){

                $this->predio->valor_catastral *= (1 + 15 / 100);

            }

            $this->predio->save();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

            $this->dispatch('mostrarMensaje', ['success', "La información se guardó con éxito"]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar el valor del predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function revisarPorcentaje(){

        $sumaTerrenos = 0;
        $sumaConstrucciones = 0;

        foreach ($this->terrenosCondominio as $terreno){

            $sumaTerrenos += (float)$terreno['indiviso_terreno'];

        }

        foreach ($this->construccionesCondominio as $construccion) {

            $sumaConstrucciones += (float)$construccion['indiviso_construccion'];

        }

        if($sumaTerrenos > 100){

            $this->dispatch('mostrarMensaje', ['error', "La suma de los indivisos de terreno de área común es mayor al 100%."]);

            return true;

        }

        if($sumaConstrucciones > 100){

            $this->dispatch('mostrarMensaje', ['error', "La suma de los indivisos de construcciones de área común es mayor al 100%."]);

            return true;

        }

        return false;

    }

    public function mount(){

        $this->usos = Constantes::USO_PREDIO;

        $this->ubicaciones = Constantes::UBICACION_PREDIO;

        $this->terrenos = [
            ['superficie' => null, 'valor_unitario' => null, 'demerito' => null, 'id' => null, 'valor_demeritado' => null, 'valor_terreno' => null]
        ];

        $this->construcciones = [
            ['codigo' => null, 'niveles' => null, 'superficie' => null, 'id' => null, 'valor_unitario' => null, 'valores' => null, 'uso' => null, 'tipo' => null, 'categoria' => null, 'calidad' => null, 'valor_construccion' => null]
        ];

        $this->terrenosCondominio = [
            ['area_terreno_comun' => null, 'indiviso_terreno' => null, 'valor_unitario' => null, 'id' => null, 'valor_terreno_comun' => null,]
        ];

        $this->construccionesCondominio = [
            ['area_comun_construccion' => null, 'indiviso_construccion' => null, 'valor_clasificacion_construccion' => null, 'id' => null, 'valor_construccion_comun' => null,]
        ];

        $this->valores_rusticos = ValoresUnitariosRusticos::all();

        $this->valores_construccion = ValoresUnitariosContruccion::all();

        $this->avaluo = Avaluo::make();

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->cargarPredio($avaluo->predio->id);

        }

    }

    public function render()
    {
        return view('livewire.valuacion.valor');
    }
}
