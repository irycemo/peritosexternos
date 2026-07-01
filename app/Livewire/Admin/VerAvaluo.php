<?php

namespace App\Livewire\Admin;

use App\Models\Avaluo;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class VerAvaluo extends Component
{

    public Avaluo $avaluo;
    public $predio;

    public $modal_revision = false;
    public $observacion;

    public function revisar(){

        $this->validate(['observacion' => 'required']);

        try {

            $this->avaluo->revisiones()->create([
                'observaciones' => $this->observacion,
                'creado_por' => auth()->id()
            ]);

            $this->reset(['modal_revision', 'observacion']);

            $this->dispatch('mostrarMensaje', ['success', "La revisión se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear revisión por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->predio = $this->avaluo->predio;

        $this->predio->load('propietarios.persona');

    }

    public function render()
    {
        return view('livewire.admin.ver-avaluo')->extends('layouts.admin');
    }

}
