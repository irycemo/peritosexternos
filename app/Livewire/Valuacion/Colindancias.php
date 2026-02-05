<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Constantes\Constantes;
use App\Traits\ColindanciasTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Colindancias extends Component
{

    use ColindanciasTrait;

    public $avaluo_id;
    public $predio;

    protected function rules(){

        return [
                'medidas.*' => 'nullable',
                'medidas.*.viento' => 'required|string',
                'medidas.*.longitud' => [
                                            'required',
                                            'numeric',
                                            'min:0',
                                        ],
                'medidas.*.descripcion' => 'required',
                'predio' => 'required'
            ];

    }

    protected $messages = [
        'predio.required' => 'Primero debe cargar el avaluo',
    ];

    protected $validationAttributes  = [
        'medidas.*.viento' => 'viento',
        'medidas.*.longitud' => 'longitud',
        'medidas.*.descripcion' => 'descripción',
    ];

    #[On('cargarAvaluo')]
    public function cargarAvaluo($id){

        $avaluo = Avaluo::find($id);

        $this->predio = $avaluo->predio;

        $this->cargarColindancias($this->predio);

    }

    #[On('guardarColindancias')]
    public function guardar(){

        $this->validate();

        try {

            DB::transaction(function () {

                $this->guardarColindancias($this->predio);

            });

            $this->dispatch('mostrarMensaje', ['success', "La información de las colindancias se guardó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al guardar colindancias en valuación por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->vientos = Constantes::VIENTOS;

        $this->medidas = [
            ['viento' => null, 'longitud' => null, 'descripcion' => null, 'id' => null]
        ];

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->predio = $avaluo->predio;

        }

    }

    public function render()
    {
        return view('livewire.valuacion.colindancias');
    }
}
