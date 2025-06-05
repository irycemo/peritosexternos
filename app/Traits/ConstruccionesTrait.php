<?php

namespace App\Traits;

use App\Models\Construccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ConstruccionesTrait
{

    public $construcciones = [];

    public function updatedConstrucciones($value, $index){

        $i = explode('.', $index);

        if($i[1] === 'valores'){

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

    public function agregarConstruccion(){

        $this->construcciones[] = ['superficie' => null, 'niveles' => null, 'referencia' => null, 'id' => null, 'valor_unitario' => null, 'valores' => null, 'uso' => null, 'tipo' => null, 'categoria' => null, 'calidad' => null, 'valor_construccion' => null];

    }

    public function borrarConstruccion($index){

        $this->validate(['predio' => 'required']);

        try {

            if($this->construcciones[$index]['id'] != null)
                $this->predio->construcciones()->where('id', $this->construcciones[$index]['id'])->delete();

        } catch (\Throwable $th) {
            Log::error("Error al borrar construccion por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->construcciones[$index]);

        $this->construcciones = array_values($this->construcciones);

    }

    public function guardarConstrucciones(){

        if($this->predio?->avaluo?->estado == 'notificado'){

            $this->dispatch('mostrarMensaje', ['error', "No puedes modificar un avalúo notificado."]);

            return;

        }

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

                $this->dispatch('mostrarMensaje', ['success', "Las construcciones se guardaron con éxito"]);

            });

        } catch (\Throwable $th) {
            Log::error("Error al crear construccion por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function cargarConstrucciones(){

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

        if(count($this->construcciones) == 0) $this->agregarConstruccion();

    }

}
