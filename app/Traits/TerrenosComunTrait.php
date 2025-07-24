<?php

namespace App\Traits;

use App\Models\TerrenoComun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait TerrenosComunTrait
{

    public $terrenosComun = [];

    public function updatedTerrenosComun($value, $index){

        $i = explode('.', $index);

        if(isset($this->terrenosComun[$i[0]]['indiviso_terreno'])){

            if(!is_numeric($this->terrenosComun[$i[0]]['indiviso_terreno']) || $this->terrenosComun[$i[0]]['indiviso_terreno'] > 100 || $this->terrenosComun[$i[0]]['indiviso_terreno'] < 0){

                $this->terrenosComun[$i[0]]['indiviso_terreno'] = 0;

                return;

            }

            $this->terrenosComun[$i[0]]['indiviso_terreno'] = round($this->terrenosComun[$i[0]]['indiviso_terreno'], 4);

        }

        if(isset($this->terrenosComun[$i[0]]['area_terreno_comun']) &&
            isset($this->terrenosComun[$i[0]]['indiviso_terreno']) &&
            isset($this->terrenosComun[$i[0]]['valor_unitario']))
        {

            $this->terrenosComun[$i[0]]['superficie_proporcional'] = ((float)$this->terrenosComun[$i[0]]['area_terreno_comun'] * (float)$this->terrenosComun[$i[0]]['indiviso_terreno']) / 100;

            $this->terrenosComun[$i[0]]['valor_terreno_comun'] = ((float)$this->terrenosComun[$i[0]]['area_terreno_comun'] *
                                                                                    (float)$this->terrenosComun[$i[0]]['indiviso_terreno'] *
                                                                                    (float)$this->terrenosComun[$i[0]]['valor_unitario']) / 100 ;

        }

    }

    public function agregarTerrenoComun(){

        $this->terrenosComun[] = ['codigo' => null, 'niveles' => null, 'superficie' => null, 'id' => null, 'valor_unitario' => null, 'superficie_proporcional' => null, 'valores' => null, 'uso' => null, 'tipo' => null, 'categoria' => null, 'calidad' => null];

    }

    public function borrarTerrenoComun($index){

        $this->validate(['predio' => 'required']);

        try {

            if($this->terrenosComun[$index]['id'] != null)
                $this->predio->terrenosComun()->where('id', $this->terrenosComun[$index]['id'])->delete();

        } catch (\Throwable $th) {
            Log::error("Error al borrar terreno de condominio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->terrenosComun[$index]);

        $this->terrenosComun = array_values($this->terrenosComun);

    }

    public function guardarTerrenosComun(){

        if($this->predio?->avaluo?->estado == 'notificado'){

            $this->dispatch('mostrarMensaje', ['error', "No puedes modificar un avalúo notificado."]);

            return;

        }

        $this->validate([
            'predio' => 'required',
            'terrenosComun.*' => 'required',
            'terrenosComun.*.area_terreno_comun' => 'required',
            'terrenosComun.*.indiviso_terreno' => 'required|max:100',
            'terrenosComun.*.superficie_proporcional' => 'nullable',
            'terrenosComun.*.valor_unitario' => 'required',
        ]);

        /* if($this->revisarPorcentaje()) return; */

        try {

            DB::transaction(function () {

                $sum = 0;

                $sum2 = 0;

                foreach ($this->terrenosComun as $key => $terreno) {

                    if($terreno['id'] == null){

                        $aux = $this->predio->terrenosComun()->create([
                            'area_terreno_comun' => $terreno['area_terreno_comun'],
                            'indiviso_terreno' => $terreno['indiviso_terreno'],
                            'superficie_proporcional' => $terreno['superficie_proporcional'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'valor_terreno_comun' => $terreno['valor_terreno_comun'],
                        ]);

                        $this->terrenosComun[$key]['id'] = $aux->id;

                    }else{

                        TerrenoComun::find($terreno['id'])->update([
                            'area_terreno_comun' => $terreno['area_terreno_comun'],
                            'indiviso_terreno' => $terreno['indiviso_terreno'],
                            'superficie_proporcional' => $terreno['superficie_proporcional'],
                            'valor_unitario' => $terreno['valor_unitario'],
                            'valor_terreno_comun' => $terreno['valor_terreno_comun'],
                        ]);

                    }

                    $sum = $sum + (float)$terreno['valor_terreno_comun'];

                    $sum2 = $sum2 + (float)$terreno['area_terreno_comun'];

                }

                $this->predio->area_comun_terreno = $sum2;
                $this->predio->valor_terreno_comun = $sum;

                $this->predio->valor_total_terreno = $this->predio->superficie_terreno + $sum;

                $this->predio->save();

                $this->dispatch('mostrarMensaje', ['success', "La información de terrenos en común se guardó con éxito"]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar el valor de terrenos en común por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function cargarTerrenosComun(){

        foreach ($this->predio->terrenosComun as $terreno) {

            $this->terrenosComun[] = [
                'id' => $terreno->id,
                'area_terreno_comun' => $terreno->area_terreno_comun,
                'superficie_proporcional' => $terreno->superficie_proporcional,
                'indiviso_terreno' => $terreno->indiviso_terreno,
                'valor_unitario' => $terreno->valor_unitario,
                'valor_terreno_comun' => $terreno->valor_terreno_comun,
            ];
        }

        if(count($this->terrenosComun) == 0) $this->agregarTerrenoComun();

    }

}
