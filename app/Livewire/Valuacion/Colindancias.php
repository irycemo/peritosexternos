<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use App\Models\Colindancia;
use App\Constantes\Constantes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Colindancias extends Component
{

    public Predio $predio;
    public $avaluo_id;

    public $medidas = [];
    public $vientos;

    protected $listeners = ['cargarPredio'];

    protected function rules(){
        return [
            'medidas.*' => 'required',
            'medidas.*.viento' => 'required|string',
            'medidas.*.longitud' => [
                                        'required',
                                        'numeric',
                                        'min:0',
                                    ],
            'medidas.*.descripcion' => 'required|'. utf8_encode('regex:/^[áéíóúÁÉÍÓÚñÑa-zA-Z-0-9$#.()\/\-," ]*$/'),
            'predio' => 'required'
         ];
    }

    protected $validationAttributes  = [
        'medidas.*.viento' => 'viento',
        'medidas.*.longitud' => 'longitud',
        'medidas.*.descripcion' => 'descripción',
    ];

    protected $messages = [
        'predio.required' => '. Primero debe cargar el avaluo'
    ];

    public function updatedMedidas($value, $index){

        $i = explode('.', $index);

        if(isset($this->medidas[$i[0]]['viento']) && $this->medidas[$i[0]]['viento'] == 'ANEXO'){

            $this->medidas[$i[0]]['longitud'] = 0;

        }

    }

    public function cargarPredio($id){

        $this->reset('medidas');

        $this->predio = Predio::with('colindancias', 'avaluo')->find($id);

        foreach ($this->predio->colindancias as $colindancia) {

            $this->medidas[] = [
                'id' => $colindancia->id,
                'viento' => $colindancia->viento,
                'longitud' => $colindancia->longitud,
                'descripcion' => $colindancia->descripcion,
            ];

        }

        if(count($this->medidas) == 0)
            $this->agregarMedida();

    }

    public function agregarMedida(){

        $this->medidas[] = ['viento' => null, 'longitud' => null, 'descripcion' => null, 'id' => null];

    }

    public function borrarMedida($index){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate(['predio' => 'required']);

        try {

            $this->predio->colindancias()->where('id', $this->medidas[$index]['id'])->delete();

            $this->predio->avaluo->update([
                'actualizado_por' => auth()->user()->id,
                'estado' => 'nuevo'
            ]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar colindancia por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

        unset($this->medidas[$index]);

        $this->medidas = array_values($this->medidas);

    }

    public function guardar(){

        $this->authorize('update',$this->predio->avaluo);

        $this->validate();

        try {

            DB::transaction(function () {

                foreach ($this->medidas as $key =>$medida) {

                    if($medida['id'] == null){

                        $aux = $this->predio->colindancias()->create([
                            'viento' => $medida['viento'],
                            'longitud' => $medida['longitud'],
                            'descripcion' => $medida['descripcion'],
                        ]);

                        $this->medidas[$key]['id'] = $aux->id;

                    }else{

                        Colindancia::find($medida['id'])->update([
                            'viento' => $medida['viento'],
                            'longitud' => $medida['longitud'],
                            'descripcion' => $medida['descripcion'],
                        ]);

                    }

                }

                $this->predio->avaluo->update([
                    'actualizado_por' => auth()->user()->id,
                    'estado' => 'nuevo'
                ]);

                $this->dispatch('mostrarMensaje', ['success', "Las colindacias se guardaron con éxito"]);

            });

        } catch (\Throwable $th) {
            Log::error("Error al crear medidas por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);
        }

    }

    public function mount(){

        $this->vientos = Constantes::VIENTOS;

        $this->medidas = [
            ['viento' => null, 'longitud' => null, 'descripcion' => null, 'id' => null]
        ];

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->cargarPredio($avaluo->predio->id);

        }

    }

    public function render()
    {
        return view('livewire.valuacion.colindancias');
    }

}
