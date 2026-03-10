<?php

namespace App\Livewire\Admin;

use App\Models\ValorUnitarioRustico;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ValoresUnitariosRusticos extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public ValorUnitarioRustico $modelo_editar;

    public $tipo;
    public $uso;
    public $estado;
    public $calidad;

    protected function rules(){
        return [
            'modelo_editar.valor' => 'required|numeric',
            'modelo_editar.valor_aterior' => 'required|numeric'
         ];
    }

    public function crearModeloVacio(){
        $this->modelo_editar = ValorUnitarioRustico::make();
    }

    public function abrirModalEditar(ValorUnitarioRustico $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function actualizar(){

        try{

            $this->modelo_editar->save();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El valor se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar valor unitario rustico por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    #[Computed]
    public function valores(){

        return ValorUnitarioRustico::select('id', 'concepto', 'valor', 'valor_aterior')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);
    }

    public function render()
    {
        return view('livewire.admin.valores-unitarios-rusticos')->extends('layouts.admin');
    }
}
