<?php

namespace App\Traits;

use App\Models\ConstruccionComun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ConstruccionesComunTrait
{

    public $construccionesComun = [];

    public function updatedConstruccionesComun($value, $index){

        $i = explode('.', $index);

        if(isset($this->construccionesComun[$i[0]]['indiviso_construccion'])){

            if(!is_numeric($this->construccionesComun[$i[0]]['indiviso_construccion']) || $this->construccionesComun[$i[0]]['indiviso_construccion'] > 100 || $this->construccionesComun[$i[0]]['indiviso_construccion'] < 0){

                $this->construccionesComun[$i[0]]['indiviso_construccion'] = 0;

                return;

            }

            $this->construccionesComun[$i[0]]['indiviso_construccion'] = round($this->construccionesComun[$i[0]]['indiviso_construccion'], 4);

        }

        if(isset($this->construccionesComun[$i[0]]['area_comun_construccion']) &&
            isset($this->construccionesComun[$i[0]]['indiviso_construccion']) &&
            isset($this->construccionesComun[$i[0]]['valor_clasificacion_construccion']))
        {

            $this->construccionesComun[$i[0]]['superficie_proporcional'] = ((float)$this->construccionesComun[$i[0]]['area_comun_construccion'] * (float)$this->construccionesComun[$i[0]]['indiviso_construccion']) / 100;

            $this->construccionesComun[$i[0]]['valor_construccion_comun'] = ((float)$this->construccionesComun[$i[0]]['area_comun_construccion'] *
                                                                                    (float)$this->construccionesComun[$i[0]]['indiviso_construccion'] *
                                                                                    (float)$this->construccionesComun[$i[0]]['valor_clasificacion_construccion']) / 100 ;

        }

    }

    public function agregarConstruccionComun(){

        $this->construccionesComun[] = ['area_comun_construccion' => null, 'indiviso_construccion' => null, 'superficie_proporcional' => null, 'valor_clasificacion_construccion' => null, 'id' => null, 'valor_construccion_comun' => null,];

    }

    public function borrarConstruccionComun($index){

        $this->validate(['predio' => 'required']);

        try {

            if($this->construccionesComun[$index]['id'] != null)
                $this->predio->construccionesComun()->where('id', $this->construccionesComun[$index]['id'])->delete();

        } catch (\Throwable $th) {
            Log::error("Error al borrar construcción común por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->construccionesComun[$index]);

        $this->construccionesComun = array_values($this->construccionesComun);

    }

    public function guardarConstruccionComun(){

        if($this->predio?->avaluo?->estado == 'notificado'){

            $this->dispatch('mostrarMensaje', ['error', "No puedes modificar un avalúo notificado."]);

            return;

        }

        $this->validate([
            'predio' => 'required',
            'construccionesComun.*' => 'nullable',
            'construccionesComun.*.area_comun_construccion' => 'required|numeric|gt:0',
            'construccionesComun.*.indiviso_construccion' => 'required|numeric|gt:0|max:100',
            'construccionesComun.*.valor_clasificacion_construccion' => 'required',
            'construccionesComun.*.superficie_proporcional' => 'required|numeric|gt:0',
        ]);

        try {

            DB::transaction(function () {

                $sum = 0;

                $sum2 = 0;

                foreach ($this->construccionesComun as $key => $construccion) {

                    if($construccion['id'] == null){

                        $aux = $this->predio->construccionesComun()->create([
                            'area_comun_construccion' => $construccion['area_comun_construccion'],
                            'indiviso_construccion' => $construccion['indiviso_construccion'],
                            'superficie_proporcional' => $construccion['superficie_proporcional'],
                            'valor_clasificacion_construccion' => $construccion['valor_clasificacion_construccion'],
                            'valor_construccion_comun' => $construccion['valor_construccion_comun'],
                        ]);

                        $this->construccionesComun[$key]['id'] = $aux->id;

                    }else{

                        ConstruccionComun::find($construccion['id'])->update([
                            'area_comun_construccion' => $construccion['area_comun_construccion'],
                            'indiviso_construccion' => $construccion['indiviso_construccion'],
                            'superficie_proporcional' => $construccion['superficie_proporcional'],
                            'valor_clasificacion_construccion' => $construccion['valor_clasificacion_construccion'],
                            'valor_construccion_comun' => $construccion['valor_construccion_comun'],
                        ]);

                    }

                    $sum = $sum + (float)$construccion['valor_construccion_comun'];

                    $sum2 = $sum2 + (float)$construccion['area_comun_construccion'];

                }

                $this->predio->area_comun_construccion = $sum2;
                $this->predio->valor_construccion_comun = $sum;
                $this->predio->superficie_total_construccion = $sum2 + $this->predio->construccionesComun->sum('superficie');
                $this->predio->valor_total_construccion = $this->predio->superficie_construccion + $sum;

                $this->predio->save();

                $this->predio->refresh();

                $this->dispatch('mostrarMensaje', ['success', "La información de condominio se guardó con éxito"]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar el construcciones en común por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function cargarConstruccionesComun(){

        foreach ($this->predio->construccionesComun as $construccion) {

            $this->construccionesComun[] = [
                'id' => $construccion->id,
                'area_comun_construccion' => $construccion->area_comun_construccion,
                'superficie_proporcional' => $construccion->superficie_proporcional,
                'indiviso_construccion' => $construccion->indiviso_construccion,
                'valor_clasificacion_construccion' => $construccion->valor_clasificacion_construccion,
                'valor_construccion_comun' => $construccion->valor_construccion_comun,
            ];
        }

        if(count($this->construccionesComun) == 0) $this->agregarConstruccionComun();

    }
}
