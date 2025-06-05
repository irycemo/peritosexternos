<?php

namespace App\Livewire\Valuacion;

use App\Models\Avaluo;
use App\Models\Predio;
use Livewire\Component;
use App\Models\Propietario;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class Propietarios extends Component
{

    public $predio;
    public $avaluo_id;

    protected $listeners = ['refresh'];

    #[On('cargarPredio')]
    public function cargarPredio($id){

        $this->predio = Predio::with('propietarios.persona')->find($id);

        $this->dispatch('cargarModelo', [get_class($this->predio), $this->predio->id]);

    }

    public function refresh(){

        $this->predio->load('propietarios.persona');

    }

    public function borrarActor(Propietario $propietario){

        try {

            $propietario->delete();

            $this->dispatch('mostrarMensaje', ['success', "La información se eliminó con éxito."]);

            $this->predio->refresh();

            $this->predio->load('propietarios.persona');

        } catch (\Throwable $th) {

            Log::error("Error al borrar propietario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        if($this->avaluo_id){

            $avaluo = Avaluo::with('predio')->find($this->avaluo_id);

            $this->cargarPredio($avaluo->predio_id);

        }

    }

    public function render()
    {
        return view('livewire.valuacion.propietarios');
    }
}
